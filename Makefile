## Colors
COLOR_RESET   = \033[0m
COLOR_INFO    = \033[32m
COLOR_COMMENT = \033[33m

default: help
.PHONY: help

help: ## Display this help message
	@printf "${COLOR_COMMENT}Usage:${COLOR_RESET}\n"
	@printf " make [target]\n\n"
	@printf "${COLOR_COMMENT}Available targets:${COLOR_RESET}\n"
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; { \
		printf " ${COLOR_INFO}%-30s${COLOR_RESET} %s\n", $$1, $$2 \
	}'

################
# Dependencies #
################

vendor: composer.json composer.lock
	composer install

.PHONY: install

install: vendor

########
# Test #
########

test: TEST:=1
test: vendor ## Run all tests
	./vendor/bin/phpspec run -fdot
