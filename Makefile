sail=./vendor/bin/sail

install-composer:
	- rm composer-setup.php
	php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
	php -r "if (hash_file('sha384', 'composer-setup.php') === '756890a4488ce9024fc62c56153228907f1545c228516cbf63f885e036d37e9a59d27d63f46af1d4d07ee0f76181c7d3') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
	php composer-setup.php
	php -r "unlink('composer-setup.php');"

install-dependencies:
	php composer.phar install
	php composer.phar require --working-dir=tools/php-cs-fixer friendsofphp/php-cs-fixer

run-dev:
	$(sail) up -d

stop-dev:
	$(sail) down

install-dependencies-assets:
	$(sail) npm install

run-assets: install-dependencies-assets
	$(sail) npm run dev

compile-assets: install-dependencies-assets
	$(sail) npm run prod

migrate:
	$(sail) artisan migrate

migrate-seed: migrate
	$(sail) artisan db:seed

lint:
	tools/php-cs-fixer/vendor/bin/php-cs-fixer fix
