#!/bin/bash

# PRE REQUISITES:
	# Install file is in sites folder
	# Build: chmod 777 install.sh
	# Run: . install.sh


# Set repo location
# ------------------------------------------------------------------------------
sagerepo='https://github.com/roots/sage.git'
plugins="https://github.com/mavieth/wpx.git"

localuser=$(whoami)
sites=/Users/$localuser/sites
cd $sites


if [ ! -d "wpx" ]; then
	echo "Downloading prerequisite $plugins"
	git clone $plugins
fi

echo "Please enter the name of the new wp directory:"
read  wp_dir
mkdir $wp_dir

cd $wp_dir
wp core download

echo "New Directory Created at: $sites/$wp_dir"

# Accepts comma sep. list of pages to create
echo "Add Pages: "
read -e allpages



# # Build new database
# # ------------------------------------------------------------------------------
echo "Enter the name of the new database:"
read  db_name
dbuser=$db_name
dbuser+=_user
newpassword=$db_name
newpassword+=_pass1234
dbprefix=wp_


echo "Enter the MySQL root password:"
read  rootpassword

db="create database $db_name;GRANT ALL PRIVILEGES ON $db_name.* TO $dbuser@localhost IDENTIFIED BY '$newpassword';FLUSH PRIVILEGES;"
mysql -u root -p$rootpassword -e "$db"



# # Create Wordpress
# # ------------------------------------------------------------------------------
if [ $? != "0" ]; then  # Note: "0" is the return from successful completion of the previous operation in BASH.
	echo "[Error]: Database creation failed"
	exit 1
else
	wp core config --dbname=$db_name --dbuser=$dbuser --dbpass=$newpassword --dbhost=localhost --dbprefix=$dbprefix
	echo "Enter WP Password"
	read wppassword

	echo "Enter WP Username"
	read wpuser

	wp core install --url=http://localhost/~$localuser/$wp_dir --title="Basic Test Site" --admin_user=$wpuser --admin_password=$wppassword --admin_email=mavieth@gmail.com
fi



# # Update WordPress Options
# # ------------------------------------------------------------------------------
# discourage search engines
wp option update blog_public 0

# show only 6 posts on an archive page
wp option update posts_per_page 6

# delete sample page, and create homepage
wp post delete $(wp post list --post_type=page --posts_per_page=1 --post_status=publish --pagename="sample-page" --field=ID --format=ids)
wp post delete 1


# create all of the pages
export IFS=","
for page in $allpages; do
	wp post create --post_type=page --post_status=publish --post_author=$(wp user get $wpuser --field=ID --format=ids) --post_title="$(echo $page | sed -e 's/^ *//' -e 's/ *$//')"
done

# set pretty urls
wp rewrite structure '/%postname%/' --hard
wp rewrite flush --hard

# add pages to navigation
export IFS=" "
for pageid in $(wp post list --order="ASC" --orderby="date" --post_type=page --post_status=publish --posts_per_page=-1 --field=ID --format=ids); do
	wp menu item add-post 'primary-navigation' $pageid
done

# assign navigaiton to primary location
wp menu location assign main-navigation primary-navigation


setup_theme () {
	cd $sites/$wp_dir/wp-content/themes
	
	echo "Change Theme Name:"
	read themename
	git clone $sagerepo $themename

	# Change first line of style.css to avoid confusion
	themeline="Theme Name: "
	themeline+=$themename

	awk -v stylename="$themeline" '{ if (NR == 1) print stylename; else print $0}' $sites/$wp_dir/wp-content/themes/$themename/style.css > $sites/$wp_dir/wp-content/themes/$themename/stylemod.css
	echo "Enter Sudo Password:"
	sudo cp $sites/$wp_dir/wp-content/themes/$themename/stylemod.css $sites/$wp_dir/wp-content/themes/$themename/style.css
	rm -rf $sites/$wp_dir/wp-content/themes/$themename/stylemod.css

	# Backup original config file
	cp $sites/$wp_dir/wp-config.php $sites/$wp_dir/wp-config.bak.php

	# Add a new line
	newline="/* Define the Roots Environment */\ndefine('WP_ENV', 'development');\n"

	# Insert into a temporary file
	awk -v insert="$newline" 'NR==3{print insert}1' $sites/$wp_dir/wp-config.php > $sites/$wp_dir/wp-config-temp.php

	# Copy to wp-config.php
	cp $sites/$wp_dir/wp-config-temp.php $sites/$wp_dir/wp-config.php

}

# 2
function install_plugins {

	# go to plugins directory
	cd $sites/$wp_dir/wp-content/plugins


	# Soil
	git clone https://github.com/roots/soil.git
	wp plugin activate soil

	# Delete terrible plugins
	wp plugin delete akismet
	wp plugin delete hello

	# Deleting sidebar widgets
	wp widget delete search-2
	wp widget delete archives-2
	wp widget delete recent-posts-2
	wp widget delete recent-comments-2
	wp widget delete meta-2
	wp widget delete categories-2

	# install plugins
	wp plugin install $sites/wpx/plugins/wp-sync-db.zip --activate
	wp plugin install $sites/wpx/plugins/wp-sync-db-media-files.zip --activate

	wp plugin install advanced-custom-fields --activate

}


function setup_node_and_gulp {
	cd $sites/$wp_dir/wp-content/themes/
	wp theme activate $themename
	cd $themename
	# Update URL
	replace "http://example.dev" "http://localhost/~$localuser/$wp_dir" -- assets/manifest.json
	npm install
	bower install
	gulp
	# Open Sublime
	subl .
}



function default_setup {
	install_plugins
	setup_theme
	setup_node_and_gulp
}


echo "================================================================="
echo "Installation is complete. Your localuser/password is listed below."
echo ""
echo "Username: $wpuser"
echo "Password: $wppassword"
echo ""
echo "================================================================="


read -p "Run default Sage/Gulp/NPM/Bower Install?? [yn]" answer
if [[ $answer = y ]] ; then
  default_setup
fi
 
cd $sites/$wp_dir/wp-content/


