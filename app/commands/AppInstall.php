<?php
/**
 * AppInstall.php
 * 
 * @author: Cyw
 * @email: chenyunwen01@bianfeng.com
 * @created: 2014-11-21 下午1:50:09
 * @logs: 
 *       
 */
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class AppInstall extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'app:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '';

    /**
     * Holds the user information.
     *
     * @var array
     */
    protected $userData = array(
        'username' => null,
        'nickname' => null,
        'roleid' => 3,
        'email' => null,
        'password' => null
    );

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        
        // drop tables
        Schema::dropIfExists('mcc_user');
        Schema::dropIfExists('mcc_role');
        Schema::dropIfExists('mcc_menu');
        Schema::dropIfExists('mcc_action_log');
        Schema::dropIfExists('mcc_migrations');
        Schema::dropIfExists('mcc_password_reminders');
        
        $this->comment('=====================================');
        $this->comment('');
        $this->info('  Step: 1');
        $this->comment('');
        $this->info('    Please follow the following');
        $this->info('    instructions to create your');
        $this->info('    default user.');
        $this->comment('');
        $this->comment('-------------------------------------');
        $this->comment('');
        
        // Let's ask the user some questions, shall we?
        $this->askUserSomething('username');
        $this->askUserSomething('nickname');
        $this->askUserSomething('roleid');
        $this->askUserSomething('email');
        $this->askUserSomething('password');
        
        $this->comment('');
        $this->comment('');
        $this->comment('=====================================');
        $this->comment('');
        $this->info('  Step: 2');
        $this->comment('');
        $this->info('    Preparing your Application');
        $this->comment('');
        $this->comment('-------------------------------------');
        $this->comment('');
        
        // Generate the Application Encryption key
        $this->call('key:generate');
        
        // Create the migrations table
        $this->call('migrate:install');
        
        // Run the Sentry Migrations
//         $this->call('migrate', array(
//             '--package' => 'cartalyst/sentry'
//         ));
        
        // Run the Migrations
        $this->call('migrate');
        
        //$this->comment(json_encode($this->userData));
        
        \UserModel::create($this->userData);
        // Create the default user and default groups.
        // $this->sentryRunner();
        
        // Seed the tables with dummy data
        $this->call('db:seed');
    }

    protected function askUserSomething($type)
    {
        do {
            
            $extmessage = array(
                'roleid' => '[superadmin = 1, admin = 2, normal = 3]'
            );
            $msg = isset($extmessage[$type]) ? $extmessage[$type] : '';
            
            $value = $this->ask(sprintf('Please enter your %s: %s  ', $type , $msg));
            
            switch ($type) {
                case 'password':
                    $value = \Hash::make($value);
                break;
                case 'roleid':
                    if (!is_numeric($value))
                    {
                        $this->error(sprintf('Your %s is must a number. Please try again.', $type));
                    }
                break;
                case '':
                    $this->error(sprintf('Your %s is invalid. Please try again.', $type));
                break;
            }
            $this->userData[$type] = $value;
        } while (! $value);
    }

    /**
     * Runs all the necessary Sentry commands.
     *
     * @return void
     */
    protected function sentryRunner()
    {
        
        // Create the default groups
        $this->sentryCreateDefaultGroups();
        
        // Create the user
        $this->sentryCreateUser();
        
        // Create dummy user
        $this->sentryCreateDummyUser();
    }

    /**
     * Creates the default groups.
     *
     * @return void
     */
    protected function sentryCreateDefaultGroups()
    {
        try {
            // Create the admin group
            $group = Sentry::getGroupProvider()->create(array(
                'name' => 'Admin',
                'permissions' => array(
                    'admin' => 1
                )
            ));
            
            // Show the success message.
            $this->comment('');
            $this->info('Admin group created successfully.');
        } catch (Cartalyst\Sentry\Groups\GroupExistsException $e) {
            $this->error('Group already exists.');
        }
    }

    /**
     * Create the user and associates the admin group to that user.
     *
     * @return void
     */
    protected function sentryCreateUser()
    {
        
        // Prepare the user data array.
        $data = array_merge($this->userData, array(
            'activated' => 1,
            'permissions' => array(
                'admin' => 1
            )
        ));
        
        // Create the user
        $user = Sentry::getUserProvider()->create($data);
        
        // Associate the Admin group to this user
        $group = Sentry::getGroupProvider()->findById(1);
        $user->addGroup($group);
        
        // Show the success message
        $this->comment('');
        $this->info('Your user was created successfully.');
    }

    /**
     * Create a dummy user.
     *
     * @return void
     */
    protected function sentryCreateDummyUser()
    {
        
        // Prepare the user data array.
        $data = array(
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => 'admin',
            'activated' => 1,
            'permissions' => array(
                'admin' => 1
            )
        );
        
        // Create the user
        $user = Sentry::getUserProvider()->create($data);
        
        // Associate the Admin group to this user
        $group = Sentry::getGroupProvider()->findById(1);
        $user->addGroup($group);
        
        // Show the success message
        $this->comment('');
        $this->info('Admin user was created successfully.');
        $this->comment('');
    }
}
