# SnowTricks

[![Codacy Badge](https://app.codacy.com/project/badge/Grade/a2a3bda5d6204a31894a39d8091de20f)](https://www.codacy.com/gh/magali-thuaire/oc-snowtricks/dashboard?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=magali-thuaire/oc-snowtricks&amp;utm_campaign=Badge_Grade)

## Setup

**Get the git Repository**

Clone over SSH

```
git clone git@github.com:magali-thuaire/oc-snowtricks.git
```

Clone over HTTPS

```
git clone https://github.com/magali-thuaire/oc-snowtricks.git
```

**Download Composer dependencies**

Make sure you have [Composer installed](https://getcomposer.org/download/)
and then run:

```
composer install
```

**Server Setup**

Configure your <span style="color:green">**php.ini**</span> file.

```
PHP version >=8.0.2
date.timezone = "Europe/Paris"
```

**Database Setup**

The code comes with a `docker-compose.yaml` file.
You will still have PHP installed
locally, but you'll connect to a database inside Docker.

First, make sure you have [Docker installed](https://docs.docker.com/get-docker/)
and running. To start the container, run:

```
docker-compose up -d
```

Next, build the database and execute the migrations with:

```
# "symfony console" is equivalent to "bin/console"
# but its aware of the database container
symfony console doctrine:database:create
symfony console doctrine:migrations:migrate
symfony console doctrine:fixtures:load
```

(If you get an error about "MySQL server has gone away", just wait
a few seconds and try again - the container is probably still booting).

If you do *not* want to use Docker, just make sure to start your own
database server and update the `DATABASE_URL` environment variable in
`.env` or `.env.local` before running the commands above.

```
MySQL version >=8.0.28
```

**Start the Symfony web server**

You can use Nginx or Apache, but Symfony's local web server
works even better.

To install the Symfony local web server, follow
"Downloading the Symfony client" instructions found
here: [Symfony CLI](https://symfony.com/download) - you only need to do this
once on your system.

Then, to start the web server, open a terminal, move into the
project, and run:

```
symfony serve -d
```

(If this is your first time using this command, you may see an
error that you need to run `symfony server:ca:install` first).

Now check out the site at `https://localhost:8000`

**Optional: Webpack Encore Assets**

This app uses Webpack Encore for the CSS, JS and image files. But
to keep life simple, the final, built assets are already inside the
project. So... you don't need to do anything to get thing set up!

If you *do* want to build the Webpack Encore assets manually, you
totally can! Make sure you have [yarn](https://yarnpkg.com/lang/en/)
installed and then run:

```
yarn install
yarn encore dev --watch
```

## Default Connexions
```
ROLE SUPERADMIN
login: superadmin
password: snowtricks
```

```
ROLE ADMIN
login: admin
password: snowtricks
```

```
ROLE USER
login: user
password: snowtricks
```