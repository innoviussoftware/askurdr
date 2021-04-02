//Follow Up Closed - 24/03/2020
            // $followupdate=EmrDetails::where('patient_id',request('patient_id'))->where('doctor_id',request('doctor_id'))->latest()->first();
            // $currentdate=date('Y-m-d');

            // if(isset($followupdate))
            // {
            //      if($followupdate->enddate <= $currentdate)
            //      {
                        
            //             $followupdates=EmrDetails::where('id',$emr_lastId)->update(['call_type'=>'followup']);
            //      }
            //      else{
            //             //Payment Functions
            //             $doctors=User::where('id',request('doctor_id'))->first();

            //             $fees=isset($doctors)?$doctors->fees:'';//Doctor Fees 

            //             $commission_final=isset($doctors)?$doctors->commision:'';//Doctor Commission 

            //             $discount=isset($doctors)?$doctors->discount:'';//Doctor Discount 

            //             if($discount > 0)
            //             {
            //                 $feesdiscount=$fees*$discount/100;    
            //                 $vat=$feesdiscount*5/100; //Vat Is Here 5%;
            //                 $total_fees_with_vat=$vat+$feesdiscount;
            //             }
            //             else{
            //                 $vat=$fees*5/100; //Vat Is Here 5%;
            //                 $total_fees_with_vat=$vat+$fees;
            //             }
                    
            //             $doctor_commission=$total_fees_with_vat*$commission_final/100;

            //             $patient_wallet=User::where('id',request('patient_id'))->first();//Patient Wallet Money

            //             $patient_wallet_money=isset($patient_wallet)?$patient_wallet->wallet_money:'';
                        
            //             if($fees <= $patient_wallet_money)
            //             {   

            //                 $update_patient_wallet_money=$patient_wallet_money-$total_fees_with_vat;//Update Wallet Money Patient

            //                 $patient_wallet=User::where('id',request('patient_id'))->update(['wallet_money'=>$update_patient_wallet_money]);//Update Patient Wallet

            //                 $clinic_wallet=DoctorClinic::where('user_id',request('doctor_id'))->first();//Doctor Clinic

            //                 $clinic=Clinic::where('id',isset($clinic_wallet)?$clinic_wallet->clinic_id:'')->first();//Clinic Wallet Money

            //                 if($clinic)
            //                 {
            //                     $clinic_name=isset($clinic->name)?$clinic->name:'';

            //                     if($clinic_name=='Ask' || $clinic_name=='ask')
            //                     {

            //                         $clinic_wallet_money=isset($clinic)?$clinic->wallet_money:'';

            //                         $update_clinic_money=$clinic_wallet_money+$doctor_commission;

            //                         $clinic_wallets=Clinic::where('id',isset($clinic_wallet)?$clinic_wallet->clinic_id:'')->update(['wallet_money'=>$update_clinic_money]);//Update Patient 

            //                         $ClinicWalletHistory=new ClinicWalletHistory;
            //                         $ClinicWalletHistory->clinic_id=isset($clinic_wallet)?$clinic_wallet->clinic_id:'';
            //                         $ClinicWalletHistory->commission=$doctor_commission;
            //                         $ClinicWalletHistory->save();

            //                         $doctors=User::where('id',request('patient_id'))->update(['wallet_money'=>$fees]);
            //                     }
            //                     else
            //                     {


            //                         $askclinic_wallet=Clinic::where('name','=','Ask')->first();
             
            //                         $clinic_wallet_money=isset($askclinic_wallet)?$askclinic_wallet->wallet_money:'';

            //                         $update_askmoney=$clinic_wallet_money+$doctor_commission;

            //                         $askclinic_wallets=Clinic::where('id',isset($askclinic_wallet)?$askclinic_wallet->clinic_id:'')->update(['wallet_money'=>$update_askmoney]);//Update Patient 

            //                         $ClinicWalletHistory=new ClinicWalletHistory;
            //                         $ClinicWalletHistory->clinic_id=isset($askclinic_wallet)?$askclinic_wallet->clinic_id:'';
            //                         $ClinicWalletHistory->commission=$doctor_commission;
            //                         $ClinicWalletHistory->save();

            //                         $clinic_wallet_money=isset($clinic)?$clinic->wallet_money:'';

            //                         $update_clinic_money=$clinic_wallet_money+$doctor_commission;

            //                         $clinic_wallets=Clinic::where('id',isset($clinic_wallet)?$clinic_wallet->clinic_id:'')->update(['wallet_money'=>$fees]);//Update Patient 


            //                         $ClinicWalletHistory=new ClinicWalletHistory;
            //                         $ClinicWalletHistory->clinic_id=isset($clinic_wallet)?$clinic_wallet->clinic_id:'';
            //                         $ClinicWalletHistory->commission=$doctor_commission;
            //                         $ClinicWalletHistory->save();
            //                     }
            //                 }

            //             $payment_history = new Payment_history;
            //             $payment_history->user_id = request('patient_id');      // user
            //             $payment_history->user_id2 = request('doctor_id');  // doctor
            //             $payment_history->price = $total_fees_with_vat;
            //             $payment_history->message = "Pay fees of doctor SAR".$total_fees_with_vat;
            //             $payment_history->save();
            //         }
            //         //End Payment Functions  
            //         $followupdates=EmrDetails::where('id',$emr_lastId)->update(['call_type'=>'followup']);
            //     }
            // }
            // else{
                
            //     $followupdates=EmrDetails::where('id',$emr_lastId)->update(['call_type'=>'regular']);
                
            // }