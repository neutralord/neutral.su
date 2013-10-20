set :application, "neutral.su"
set :domain,      "neutral.su"
set :user,        "neutral"
set :deploy_to,   "/home/neutral/www/neutral.su"
set :app_path,    "app"
set :web_path,    "web"

set :repository,  "https://github.com/neutralord/neutral.su.git"
set :scm,         :git

set :model_manager, "doctrine"

role :web,        domain
role :app,        domain, :primary => true

set  :use_sudo,   false

set :shared_files,      [app_path + "/config/parameters.yml"]
set :shared_children,     [app_path + "/logs", web_path + "/upload", "vendor"]

set :use_composer, true
set :update_vendors, true

set :dump_assetic_assets,   true

set :writable_dirs,       ["app/cache"]
set :webserver_user,      "www-data"
set :permission_method,   :acl
set :use_set_permissions, true

logger.level = Logger::MAX_LEVEL
