#!/bin/bash

root=$( dirname $( wp config path ) )

wp theme activate wporg-showcase-2022

wp rewrite structure '/%postname%/'
wp rewrite flush --hard

wp option update blogname "The WordPress Showcase"
wp option update blogdescription "The Best WordPress Sites in the Wordl"

wp import "${root}/env/showcase-posts.xml" --authors=create
wp import "${root}/env/showcase-pages.xml" --authors=create
