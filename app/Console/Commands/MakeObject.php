<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MakeObject extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:object {objectName}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    private string $className = '';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->className = $this->argument('objectName');
        $fileName = $this->className . '.php';
        $path ='app\Http\Objects\\' . $fileName;
        
        if (!file_exists($path)) {
           if($file = fopen($path, "w")) {
            fwrite($file, $this->getContent());
            fclose($file);
           } else {
                $this->log('Unable to open ' . $fileName);
           }
        } else {
            $this->log('Object ' . $fileName . ' already exists.');
        }
    }

    private function log(string $output): bool {
        $this->output->write($output, false);

        return true;
    }

    private function getContent(): string {

$text = 
'
<?php 
    namespace App\Objects;

    use Illuminate\Support\HtmlString;
    use App\Models\Block;

    class '. $this->className .'
    {
        static function render(): Htmlstring {
            $html = "<div></div>";

            return new Htmlstring($html);
        }
    }
?>
';

        return trim($text);
    }
}
