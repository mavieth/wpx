#!/bin/bash

# PRE REQUISITES:
	# Install file is in sites folder
	# Build: chmod 777 install.sh
	# Run: . install.sh


# ------------------------------------------------------------------------------
# Set repo location
sagerepo='https://github.com/mavieth/sage.git'
wpxfiles="https://github.com/mavieth/wpx.git"

localusername=$(whoami)
sitedir='/Users/'$localusername/'Sites'
cd $sitedir




echo "Please enter the name of the new wp directory:"
read  wp_dir
mkdir $wp_dir

cd $wp_dir
wp core download

echo "New Directory Created at: $sitedir/$wp_dir"

# Accepts comma sep. list of pages to create
echo "Add Pages: "
read -e allpages



# # ------------------------------------------------------------------------------
# # Build new database
echo "This script will create a local database with a new user. Username & password based on DB name, but this is OK because we're working LOCALLY."
echo "Enter the name of the new database:"
read  db_name

# Set up variables
# Username is just the "salted" db name. For publicly accessible databases, make this more secure.
dbuser=$db_name
dbuser+=_user
# Password is just the "salted" db name. Adjust this for better passwords - require user input.
newpassword=$db_name
newpassword+=_pass1234

# # For security purposes, ask for a table prefix. Default to 'wp_'
# # Do this on the local dev site to ease later uploads
dbprefix=wp_

# echo "Please enter a database table prefix. Leave out the underscore. Defaults to 'wp_'."
# read dbprefix
# dbprefix+="_"

# if [ "$dbprefix" = "" ]; then
#     $dbprefix=wp_
# fi


echo "Enter the MySQL root password:"
read  rootpassword

db="create database $db_name;GRANT ALL PRIVILEGES ON $db_name.* TO $dbuser@localhost IDENTIFIED BY '$newpassword';FLUSH PRIVILEGES;"
mysql -u root -p$rootpassword -e "$db"

if [ $? != "0" ]; then  # Note: "0" is the return from successful completion of the previous operation in BASH.
	echo "[Error]: Database creation failed"
	exit 1
else
	wp core config --dbname=$db_name --dbuser=$dbuser --dbpass=$newpassword --dbhost=localhost --dbprefix=$dbprefix
	echo "Enter WP Password"
	read wppassword

	echo "Enter WP Username"
	read wpuser

	wp core install --url=http://localhost/~$localusername/$wp_dir --title="Basic Test Site" --admin_user=$wpuser --admin_password=$wppassword --admin_email=mavieth@gmail.com
fi


# discourage search engines
wp option update blog_public 0

# show only 6 posts on an archive page
wp option update posts_per_page 6

# delete sample page, and create homepage
wp post delete $(wp post list --post_type=page --posts_per_page=1 --post_status=publish --pagename="sample-page" --field=ID --format=ids)
wp post create --post_type=page --post_title=Home --post_status=publish --post_author=$(wp user get $wpuser --field=ID --format=ids)

# set homepage as front page
wp option update show_on_front 'page'

# set homepage to be the new page
wp option update page_on_front $(wp post list --post_type=page --post_status=publish --posts_per_page=1 --pagename=home --field=ID --format=ids)

# create all of the pages
export IFS=","
for page in $allpages; do
	wp post create --post_type=page --post_status=publish --post_author=$(wp user get $wpuser --field=ID --format=ids) --post_title="$(echo $page | sed -e 's/^ *//' -e 's/ *$//')"
done

# set pretty urls
wp rewrite structure '/%postname%/' --hard
wp rewrite flush --hard

# create a navigation bar
wp menu create "Main Navigation"

# add pages to navigation
export IFS=" "
for pageid in $(wp post list --order="ASC" --orderby="date" --post_type=page --post_status=publish --posts_per_page=-1 --field=ID --format=ids); do
	wp menu item add-post main-navigation $pageid
done

# assign navigaiton to primary location
wp menu location assign main-navigation primary


setup_theme () {
	cd $sitedir/$wp_dir/wp-content/themes
	
	echo "Change Theme Name:"
	read themename
	git clone $sagerepo $themename

	git clone $wpxfiles $themename/wpx

	# Change first line of style.css to avoid confusion
	themeNameUpdate="Theme Name: "
	themeNameUpdate+=$themename

	awk -v stylename="$themeNameUpdate" '{ if (NR == 1) print stylename; else print $0}' $sitedir/$wp_dir/wp-content/themes/$themename/style.css > $sitedir/$wp_dir/wp-content/themes/$themename/stylemod.css
	echo "Enter Sudo Password (optional):"
	sudo cp $sitedir/$wp_dir/wp-content/themes/$themename/stylemod.css $sitedir/$wp_dir/wp-content/themes/$themename/style.css
	rm -rf $sitedir/$wp_dir/wp-content/themes/$themename/stylemod.css

	# Backup original config file
	cp $sitedir/$wp_dir/wp-config.php $sitedir/$wp_dir/wp-config.bak.php

	# Add a new line
	newline="/* Define the Roots Environment */\ndefine('WP_ENV', 'development');\n"

	# Insert into a temporary file
	awk -v insert="$newline" 'NR==3{print insert}1' $sitedir/$wp_dir/wp-config.php > $sitedir/$wp_dir/wp-config-temp.php

	# Copy to wp-config.php
	cp $sitedir/$wp_dir/wp-config-temp.php $sitedir/$wp_dir/wp-config.php

}

# 2
function install_plugins {
	# delete akismet and hello dolly
	wp plugin delete akismet
	wp plugin delete hello

	# install wpxfiles
	wp plugin install $sitedir/wpx/plugins/wp-sync-db.zip --activate
	wp plugin install $sitedir/wpx/plugins/wp-sync-db-media-files.zip --activate
	wp plugin install advanced-custom-fields --activate
}

# 3
function install_soil {
	cd $sitedir/$wp_dir/wp-content/plugins
	git clone https://github.com/roots/soil.git
	wp plugin activate soil
}

# 4
function setup_node {
	cd $sitedir/$wp_dir/wp-content/themes/
	wp theme activate $themename
	cd $themename
	replace "http://example.dev" "http://localhost/~$localusername/$wp_dir" -- assets/manifest.json
	npm install
	bower install
}

# 5
function run_gulp {
	cd $sitedir/$wp_dir/wp-content/themes/$themename
	subl .
	gulp
	gulp watch
}

# 6
function default_setup {
	install_plugins
	install_soil
	setup_theme
	setup_node
	run_gulp
}


echo "================================================================="
echo "Installation is complete. Your localusername/password is listed below."
echo ""
echo "Username: $wpuser"
echo "Password: $wppassword"
echo ""
echo "================================================================="


read -p "Run default Sage/Gulp/NPM/Bower Install?? [yn]" answer
if [[ $answer = y ]] ; then
  default_setup
fi
