<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Util;

class AppointmentReminder extends Command {

	
	protected $name = 'email:appoitmentReminder';
	
	/**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:appoitmentReminder';
    
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Appointment reminder for Associates and prospects';
        

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
    
    public function fire()
    {
    	$this->info('Daily Updates sent successfully');
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
    	Log::info("<//------------------- AppointmentReminder -------------------> ");
    	
		$results = DB::select ( DB::raw ( "SELECT a103_name, a103_lastname, a102_name, a102_lastname,
						  a103_email, a114_startdate, a114_starttime, a102_email, a016_name
					FROM  t114_appointment
					INNER JOIN t103_prospect ON ( a114_prospectid = a103_id ) 
					INNER JOIN t102_associate ON ( a102_id = a114_associateid ) 
					INNER JOIN t016_appointment_location ON ( a016_id = a114_locationid ) 
					WHERE DATE( a114_startdate ) = ( CURDATE( ) + INTERVAL 1 DAY ) 
					AND a114_companyid = 69 ") ); //( SELECT 1 FROM dual )
				
		Log::info("        There were found ". count($results). " appointments ");
		
		$contEmail = 0;
		foreach ($results as $appointment) {
			
			/*$arrayEmail = [];	
			$arrayEmail[] += $appointment->a102_email;
			*/
			$associateName = $appointment->a102_name . " " . $appointment->a102_lastname;;
			$prospectName = $appointment->a103_name . ' '. $appointment->a103_lastname;
			
			/*if($appointment->a103_email != "")
			{
				/*$arrayEmail[][0] += $appointment->a103_email;
				$arrayEmail[][1] += $prospectName;
				
				//add message to cance
				//Please feel free to call ys with any needed changes.
				//If you have any question regarding your appointment, please call				 
			}*/
			
			$emailContent = array(
					'name' => $appointment->a103_name . ' '. $appointment->a103_lastname,
					'associate' => $associateName,
					'time' => Util::getTimeFormat( $appointment->a114_starttime),
					'location' => $appointment->a016_name,  
					'date' => Util::getStringFormat2($appointment->a114_startdate));
			
			$email = $appointment->a102_email;
			
			$contEmail += Mail::send('emails.app-remainder',
					$emailContent,
					function ($message) use ($email, $associateName)
					{
						$message->to($email, $associateName);
						$message->bcc("yessa026@hotmail.com", "Admin");
						$message->subject('You have an appointment!');
					}
			);
		}
		
		Log::info("        There were sent ". $contEmail. " emails ");
		
		Log::info("<------------------- AppointmentReminder -------------------//> ");
    }
	
	
	
	
}