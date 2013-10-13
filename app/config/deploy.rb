set :application, "neutral.su"
set :domain,      "neutral.su"
set :user,        "neutral"
set :deploy_to,   "/home/neutral/www/neutral.su"
set :app_path,    "app"
set :web_path,    "web"

set :repository,  "git@github.com:neutralord/neutral.su.git"
set :scm,         :git

set :model_manager, "doctrine"

role :web,        domain
role :app,        domain, :primary => true

set  :use_sudo,   false

set :shared_files,      [app_path + "/config/parameters.yml"]
set :shared_children,     [app_path + "/logs", web_path + "/upload", "vendor"]

set :use_composer, true
set :update_vendors, true

logger.level = Logger::MAX_LEVEL
