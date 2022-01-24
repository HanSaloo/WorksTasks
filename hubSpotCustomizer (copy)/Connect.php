<?php
const HAPIKEY = "eu1-b68e-599d-4807-a510-185ab00f80ee";
const OWNER_ID = "237972720";
require_once 'vendor/autoload.php';

class Connect
{
    public function SwitchManager()
    {
        echo "1 - Create custom Contact\n";
        echo "2 - Create custom Deal \n";
        echo "3 - Create custom Company \n";
        echo "4 - Create custom Ticket \n";
        echo "5 - Create custom Note \n";

//        echo "9 - debug zone\n\n";


        $i = readline();
        switch ($i) {
            case 1:
                $this->PutContact();
                break;
            case 2:
                $this->PutDeal();
                break;
            case 3:
                $this->PutCompany();
                break;
            case 4:
                $this->PutTicket();
                break;
            case 5:
                $this->PutNote();
                break;
            case 99:
                //dev zone
                $this->DDoSPost();
        }
    }

    function GetCustomObj()
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.hubapi.com/crm/v3/objects/companies?limit=10&archived=false&hapikey='.HAPIKEY,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        //names list
        $res = json_decode($response, true)['results'];
        var_dump($res);
        foreach ($res as $array) {
            $namesArr[] = $array['properties']['name'];
//            $array['id'] - id of current name
        }

        print_r($namesArr);
//        echo "\n\n";


    }

    function PutContact()
    {
        echo "Enter company:\n";
        $company = readline();
        echo "Enter e-mail:\n";
        $email = readline();
        echo "Enter First name;\n";
        $fname = readline();
        echo "Enter Last name:\n";
        $lname = readline();
        echo "Enter phone:\n";
        $phone = readline();
        echo "Enter website:\n";
        $website = readline();

        echo "\n\n";

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.hubapi.com/crm/v3/objects/contacts?hapikey=' . HAPIKEY,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
  "properties": {
    "company": "' . $company . '",
    "email": "' . $email . '",
    "firstname": "' . $fname . '",
    "lastname": "' . $lname . '",
    "phone": "' . $phone . '",
    "website": "' . $website . '"
  }
}',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        print_r($response);
    }

    function PutDeal()
    {
        echo "Enter amount:\n";
        $amount = readline();
        echo "Enter close date:\n";
        $closedate = readline();
        echo "Enter deal name:\n";
        $dealname = readline();


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.hubapi.com/crm/v3/objects/deals?hapikey=' . HAPIKEY,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
  "properties": {
    "amount": "' . $amount . '",
    "closedate": "' . $closedate . '",
    "dealname": "' . $dealname . '",
    "dealstage": "appointmentscheduled",
    "hubspot_owner_id": "' . OWNER_ID . '",
    "pipeline": "default"
  }
}',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        print_r($response);
    }

    function PutCompany()
    {

        echo "Enter city:\n";
        $city = readline();
        echo "Enter domain:\n";
        $domain = readline();
        echo "Enter industry:\n";
        $industry = readline();
        echo "Enter name:\n";
        $name = readline();
        echo "Enter phone:\n";
        $phone = readline();
        echo "Enter state:\n";
        $state = readline();


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.hubapi.com/crm/v3/objects/companies?hapikey=' . HAPIKEY,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
  "properties": {
    "city": "' . $city . '",
    "domain": "' . $domain . '",
    "industry": "' . $industry . '",
    "name": "' . $name . '",
    "phone": "' . $phone . '",
    "state": "' . $state . '"
  }
}',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response[] = curl_exec($curl);
        curl_close($curl);
        print_r($response);
    }

    function PutTicket()
    {

        echo "Enter ticket priority(low, medium of high):\n";
        $priority = readline();
        $Tpriority = mb_strtoupper($priority);
        echo "Enter stage (1 - new, 2 - Waiting on contact\n 3 - Waiting on us 4 - closed):\n";
        $stage = readline();
        echo "Enter subject:\n";
        $subject = readline();


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.hubapi.com/crm/v3/objects/tickets?hapikey=' . HAPIKEY,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
  "properties": {
    "hs_pipeline": "0",
    "hs_pipeline_stage": "' . $stage . '",
    "hs_ticket_priority": "' . $Tpriority . '",
    "hubspot_owner_id": "' . OWNER_ID . '",
    "subject": "' . $subject . '"
  }
}',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        print_r($response);
    }

    function PutNote()
    {
        ///////////////////GENERATING NOTE
        echo "Enter your note:\n";
        $body = readline();

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.hubapi.com/crm/v3/objects/notes?hapikey=' . HAPIKEY,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
  "properties": {
    "hs_timestamp": "2019-10-30T03:30:17.883Z",
    "hs_note_body": "' . $body . '",
    "hubspot_owner_id": "' . OWNER_ID . '"
  }
}',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $res = json_decode($response, true);

        $note_id = 0;
        foreach ($res as $key => $val) {
            if ($key == 'id') {
                $note_id = $val;
            }
        }
//        var_dump($note_id);
////////////////////////////////////
///
/// ////////////////////////////////ASSOCIATING NOTE
        echo "Associate this note with: \n";
        echo "1 - Company: \n";
        echo "2 - Contact: \n";



        $ch = readline();
        switch ($ch){
            case 1:

                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://api.hubapi.com/crm/v3/objects/companies?limit=10&archived=false&hapikey='.HAPIKEY,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'GET',
                ));

                $response = curl_exec($curl);

                curl_close($curl);

                //names list
                $res = json_decode($response, true)['results'];
//                var_dump($res);
                foreach ($res as $array) {
                    $namesArr[$array['id']] = $array['properties']['name'];
//            $array['id'] - id of current name
                }
                $finalID = 0;
                echo "Copy associate id:\n";
                print_r($namesArr);
$finalID = readline();

//echo $finalID . $note_id;
//todo 100 comp + 1000 copm in file + 1000 contact + 1000 deal to comp
                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://api.hubapi.com/crm/v3/objects/companies/'.$finalID.'/associations/notes/'.$note_id.'/company_to_note?hapikey='.HAPIKEY,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'PUT',
                ));

                $response = curl_exec($curl);

                curl_close($curl);
                $res = json_decode($response, true);
//        var_dump($res);
                break;

            default:
                echo "wrong!\n";
                break;


        }




    }



function DDoSPost(){

    $faker = Faker\Factory::create();
        for ($i = 0; $i <1000; $i++) {
            $fname = $faker->name;
            $lname = " ";
            $phone = $faker->phoneNumber;
            $email = $faker->email;
            $company = $faker->company;
            $website = $faker->words;


            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.hubapi.com/crm/v3/objects/contacts?hapikey=' . HAPIKEY,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 1000,
                CURLOPT_TIMEOUT => 2,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{
  "properties": {
    "company": "' . $company . '",
    "email": "' . $email . '",
    "firstname": "' . $fname . '",
    "lastname": "' . $lname . '",
    "phone": "' . $phone . '",
    "website": "' . $website . '"
  }
}',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);

        }

}

}