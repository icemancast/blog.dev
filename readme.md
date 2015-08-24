# Laravel Blog

## Getting Started

1. Clone this repo into your sites folder.

2. Run ansible-playbook ansible/create-vagrant-site.yml

3. Create a database w/ ansible commands

4. Update your hosts file.

5. create your own .env.local.php file

6. run `composer install`

## Troubleshooting
- If a class name is not found and you see the file containing it, try running `composer dump-autoload` from your VM.

## ENV Setup
Use `env-template.php` as your template for $_ENV variables. Copy the contents of `env-template.php` to your own `.env.local.php` file prior to requesting any db driven pages or artisan commands.
