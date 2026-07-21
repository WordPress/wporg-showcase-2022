# Showcase Block Theme

A block-based child theme for WordPress.org Showcase, plus local environment.

This is as-yet incomplete, a starting point.

## Development

### Prerequisites

* Docker
* Node/npm
* Composer

### Setup

1. Set up repo dependencies.

    ```bash
    npm install
    composer install
    npm run setup:tools
    ```

1. Start the local environment.

    ```bash
    npx wp-env start
    ```

1. Run the setup script.

    ```bash
    npm run setup:wp
    ```

1. (optional) There may be times when you want to make changes to the Parent theme and test them with the Main them. To do that:
    1. Clone the Parent repo and follow the setup instructions in its `readme.md` file.
    1. Create a `.wp-env.override.json` file in this repo
    1. Copy the `themes` section from `.wp-env.json` and paste it into the override file. You must copy the entire section for it to work, because it won't be merged with `.wp-env.json`.
    1. Update the path to the Parent theme to the Parent theme folder inside the Parent repository you cloned above.

    ```json
    {
    	"themes": [
    		"./source/wp-content/themes/wporg-showcase",
    		"./source/wp-content/themes/wporg-showcase-2022",
    		"../wporg-parent-2021/source/wp-content/themes/wporg-parent-2021"
    	]
    }
    ```

1. Visit site at [localhost:8888](http://localhost:8888).

1. Log in with username `admin` and password `password`.

### Environment management

These must be run in the project's root folder, _not_ in theme/plugin subfolders.

* Stop the environment.

    ```bash
    npx wp-env stop
    ```

* Restart the environment.

    ```bash
    npx wp-env start
    ```

* Build the theme's JavaScript

    ```bash
    npm run build:theme
    ```

    or, automatically build on changes:

    ```bash
    npm run start:theme
    ```

* Reset WordPress to a clean install, and reconfigure. This will nuke all local WordPress content!

    ```bash
    npx wp-env clean all
    npm run setup:wp
    ```

* SSH into docker container.

    ```bash
    npx wp-env run wordpress bash
    ```

* Run wp-cli commands. Keep the wp-cli command in quotes so that the flags are passed correctly.

    ```bash
    npx wp-env run cli "wp post list --post_status=publish"
    ```

* Update composer dependencies and sync any `repo-tools` changes.

    ```bash
    npm run update:tools
    ```

* Run a lighthouse test.

    ```bash
    npm run lighthouse
    ```

