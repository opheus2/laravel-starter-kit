# lint all code
lint:
	@echo "Lint start"
	./vendor/bin/rector
	./vendor/bin/pint -v
	./vendor/bin/phpstan analyse --memory-limit=1G
	@echo "Lint complete"

# start the application
up:
	@echo "Starting the application"
	./vendor/bin/sail up -d
	@echo "Application is running at http://localhost:$(shell cat .env | grep "APP_PORT" | cut -d "=" -f 2)"

# stop the application
down:
	@echo "Stopping the application"
	./vendor/bin/sail down

# restart the application
restart: down up

# rebuild the application
rebuild:
	@echo "Rebuilding the application"
	./vendor/bin/sail down
	./vendor/bin/sail up -d --build
	@echo "Application is running at http://localhost:$(shell cat .env | grep "APP_PORT" | cut -d "=" -f 2)"

# fresh database
db-fresh:
	@echo "Refreshing the database"
	./vendor/bin/sail artisan migrate:fresh --seed
	# ./vendor/bin/sail artisan passport:client --personal --name="Personal Users Client"
	@echo "Database refreshed"

# restart horizon
horizon:
	@echo "Restarting horizon"
	./vendor/bin/sail artisan horizon:terminate
	./vendor/bin/sail artisan horizon

queue:
	@echo "Starting the queue"
	./vendor/bin/sail artisan queue:work

# show the status
status:
	@echo "Showing the status"
	./vendor/bin/sail ps

# show the logs
logs:
	@echo "Showing the logs"
	./vendor/bin/sail logs -f

# enter the application container
ssh:
	./vendor/bin/sail bash

# run js dev server
js:
	@echo "Starting the js dev server"
	./vendor/bin/sail bun run dev


# run the tests
test:
	@echo "Running the tests"
	./vendor/bin/sail test

test-watch:
	@echo "Running the tests in watch mode"
	./vendor/bin/sail pest --watch

# run the tests with coverage
test-coverage:
	@echo "Running the tests with coverage"
	./vendor/bin/sail test --coverage-clover=coverage.xml
	@echo "Tests complete"

# run js tests
test-js:
	@echo "Running the js tests"
	./vendor/bin/sail bun run test
	@echo "Js tests complete"

# Github steps

# create a new feature branch
feature:
	git checkout develop
	git pull origin develop
	@echo "Creating a new feature branch"
	@if [ -z "$(name)" ]; then \
		read -p "Enter the issue name: " name; \
	fi
	@git checkout -b $(name)
	@echo "Feature branch created"

# create a hotfix branch
hotfix:
	@if [ -z "$(name)" ]; then \
		read -p "Enter the hotfix name: " name; \
	fi
	git checkout main
	git pull origin main
	@echo "Creating a new hotfix branch"
	@git checkout -b "hotfix-$(name)"
	@echo "Hotfix branch created"

# enter the application container
sh:
	./vendor/bin/sail bash

# enter the application container as root
sh-root:
	./vendor/bin/sail root-shell
