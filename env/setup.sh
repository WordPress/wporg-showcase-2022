#!/bin/bash

root=$( dirname $( wp config path ) )

wp theme activate wporg-showcase-2022

wp rewrite structure '/%postname%/'
wp rewrite flush --hard

wp option update blogname "The WordPress Showcase"
wp option update blogdescription "The Best WordPress Sites in the World"

# Delete hello world post since we use posts for sites
wp post delete 1 --force

wp import "${root}/env/showcase-posts.xml" --authors=create
wp import "${root}/env/showcase-pages.xml" --authors=create

# Create the subnav menu
wp menu create subnav-menu
wp menu item add-post subnav-menu 91 --title="Submit a site"

wp option update show_on_front 'page'
wp option update page_on_front 1708
wp option update page_for_posts 1695
