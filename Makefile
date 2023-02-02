################################################
# Init
################################################

YOUR_NAME=$(MANYCHAT_USERNAME)
XDEBUG_PORT=$(shell php -r '$$p=__DIR__ . "/protected/config/params/personal/$(YOUR_NAME).php"; if(!is_file($$p)){die(0);} $$c=file_get_contents($$p); if($$c) {preg_match("!xdebug_port.+=>.?([0-9]+)!ui", $$c, $$r); echo $$r[1];}')

PATH_TO_ROOT_FOLDER=/home/$(YOUR_NAME)/manychat/team
SERVER_MANYCHAT=team-$(YOUR_NAME).manychat.io

CURRENT_TIME = $(shell date +%Y_%m_%d__%H_%M)

COLOR_DEFAULT=\e[97m
COLOR_YELLOW=\e[93m

################################################
# For composer
################################################

composer-install:
	composer install --ignore-platform-reqs
	ssh -p 7797 $(YOUR_NAME)@${SERVER_MANYCHAT} 'cd $(PATH_TO_ROOT_FOLDER) && composer install --ignore-platform-req=php --ignore-platform-req=composer-plugin-api'
ci: composer-install

composer-dump:
	composer dump
	ssh -p 7797 $(YOUR_NAME)@${SERVER_MANYCHAT} 'cd $(PATH_TO_ROOT_FOLDER)  && composer dump'
cd: composer-dump


################################################
# For debug
################################################

debug-tunnel:
	ssh -N -R $(XDEBUG_PORT):127.0.0.1:$(XDEBUG_PORT) -p 7797 $(YOUR_NAME)@${SERVER_MANYCHAT}
dt: debug-tunnel


################################################
# For deploy
################################################
deploy-personal:
	rsync -avzhe 'ssh -p 7797' . $(YOUR_NAME)@${SERVER_MANYCHAT}:$(PATH_TO_ROOT_FOLDER)/
dp: deploy-personal


################################################
# For migration
################################################

migrtion-create:
	ssh -p 7797 $(YOUR_NAME)@${SERVER_MANYCHAT} "cd $(PATH_TO_ROOT_FOLDER) && export ENV=$(YOUR_NAME) && php protected/yiic migration create $(n)"
	rsync -rvt -e 'ssh -p 7797' $(YOUR_NAME)@${SERVER_MANYCHAT}:$(PATH_TO_ROOT_FOLDER)/protected/migrations/ protected/migrations/
mc: migrtion-create


################################################
# For Release
################################################

release:
	git checkout develop && git pull && git checkout -b release/release_${CURRENT_TIME} && git push origin release/release_${CURRENT_TIME} && open  https://github.com/manychat/backend/pull/new/release/release_${CURRENT_TIME}?expand=1

backmerge:
	git checkout master && git pull && git checkout -B backmerge/master_to_dev_${CURRENT_TIME} && git pull . master && git push origin backmerge/master_to_dev_${CURRENT_TIME} && open  https://github.com/manychat/backend/pull/new/backmerge/master_to_dev_${CURRENT_TIME}?expand=1


################################################
# etc
################################################

server-session:
	ssh -p 7797 -t $(YOUR_NAME)@${SERVER_MANYCHAT} 'cd $(PATH_TO_ROOT_FOLDER); bash'
ss: server-session

up:
	docker-compose up -d

down:
	docker-compose down
