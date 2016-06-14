    <div class="col-md-12">
        <h4 class="fw-title"></h4>
        <div class="box-widget">
            <div class="widget-head clearfix">
                <div id="top_tabby" class="block-tabby pull-left">
                </div>
            </div>
            <div class="widget-container">
                <div class="widget-block">
                    <div class="widget-content box-padding">
                        
                       {!! Form::open(['url'=>'user/store', 'class'=>'form-horizontal left-align form-well','id'=>'stepy_form']) !!}
                           <fieldset title="Basic Info">
                               <legend>Personal Information</legend>

                               <div class="form-group">
                                   <label class="col-md-2 col-sm-2 control-label">Full Name</label>
                                   <div class="col-md-6 col-sm-6">
                                       {{-- <input class="form-control" name="fullname" type="text"/> --}}
                                       {!! Form::text('full_name','',['required' => 'required', 'id' => 'full_name' ,'class'=>'form-control','placeholder'=>'Enter your full name']) !!}
                                   </div>
                                   <span id="errMsgUserFull" class="error-msg"></span>
                               </div>
                               <div class="form-group">
                                   <label class="col-md-2 col-sm-2 control-label">Address 1</label>
                                   <div class="col-md-6 col-sm-6">
                                       {!! Form::text('address1','',['id' => 'address1' ,'class'=>'form-control', 'required' => 'required', 'placeholder'=>'Enter Address ']) !!}
                                   </div>
                                   <span id="errMsgUserAdd" class="error-msg"></span>
                               </div>
                               <div class="form-group">
                                   <label class="col-md-2 col-sm-2 control-label">Address 2</label>
                                   <div class="col-md-6 col-sm-6">
                                       {!! Form::text('address2','',['class'=>'form-control','placeholder'=>'Enter Address']) !!}
                                   </div>
                               </div>
                               <div class="form-group">
                                   <label class="col-md-2 col-sm-2 control-label">Gender</label>
                                   <div class="col-md-6 col-sm-6">
                                       {!! Form::select('gender',[
                                       '' => '--Select your gender',
                                       'male'=>'Male',
                                       'female'=>'Female'], null, ['required' => 'required','id'=>'gender','class'=>'form-control']) !!}
                                   </div>
                                   <span id="errMsgUserGen" class="error-msg"></span>
                               </div>
                               <div class="form-group">
                                   <label class="col-md-2 col-sm-2 control-label">Country</label>
                                   <div class="col-md-6 col-sm-6">
                                       {!! Form::select('country',[

                                           ''=>'--Select your country',
                                           'AF'=>'Afghanistan',
                                           'AX'=>'Aland Islands',
                                           'AL'=>'Albania',
                                           'DZ'=>'Algeria',
                                           'AS'=>'American Samoa',
                                           'AD'=>'Andorra',
                                           'AO'=>'Angola',
                                           'AI'=>'Anguilla',
                                           'AQ'=>'Antarctica',
                                           'AG'=>'Antigua and Barbuda',
                                           'AR'=>'Argentina',
                                           'AM'=>'Armenia',
                                           'AW'=>'Aruba',
                                           'AU'=>'Austratda',
                                           'AT'=>'Austria',
                                           'AZ'=>'Azerbaijan',
                                           'BS'=>'Bahamas',
                                           'BH'=>'Bahrain',
                                           'BD'=>'Bangladesh',
                                           'BB'=>'Barbados',
                                           'BY'=>'Belarus',
                                           'BE'=>'Belgium',
                                           'BZ'=>'Betdze',
                                           'BJ'=>'Benin',
                                           'BM'=>'Bermuda',
                                           'BT'=>'Bhutan',
                                           'BO'=>'Botdvia',
                                           'BA'=>'Bosnia and Herzegovina',
                                           'BW'=>'Botswana',
                                           'BV'=>'Bouvet Island',
                                           'BR'=>'Brazil',
                                           'IO'=>'British Indian Ocean Territory',
                                           'BN'=>'Brunei Darussalam',
                                           'BG'=>'Bulgaria',
                                           'BF'=>'Burkina Faso',
                                           'BI'=>'Burundi',
                                           'KH'=>'Cambodia',
                                           'CM'=>'Cameroon',
                                           'CA'=>'Canada',
                                           'CV'=>'Cape Verde',
                                           'KY'=>'Cayman Islands',
                                           'CF'=>'Central African Repubtdc',
                                           'TD'=>'Chad',
                                           'CL'=>'Chile',
                                           'CN'=>'China',
                                           'CX'=>'Christmas Island',
                                           'CC'=>'Cocos (Keetdng) Islands',
                                           'CO'=>'Colombia',
                                           'KM'=>'Comoros',
                                           'CG'=>'Congo',
                                           'CD'=>'Congo, The Democratic',
                                           'CK'=>'Cook Islands',
                                           'CR'=>'Costa Rica',
                                           'CI'=>'Cote D\'ivoire',
                                           'HR'=>'Croatia',
                                           'CU'=>'Cuba',
                                           'CY'=>'Cyprus',
                                           'CZ'=>'Czech Repubtdc',
                                           'DK'=>'Denmark',
                                           'DJ'=>'Djibouti',
                                           'DM'=>'Dominica',
                                           'DO'=>'Dominican Repubtdc',
                                           'EC'=>'Ecuador',
                                           'EG'=>'Egypt',
                                           'SV'=>'El Salvador',
                                           'GQ'=>'Equatorial Guinea',
                                           'ER'=>'Eritrea',
                                           'EE'=>'Estonia',
                                           'ET'=>'Ethiopia',
                                           'FK'=>'Falkland Islands',
                                           'FO'=>'Faroe Islands',
                                           'FJ'=>'Fiji',
                                           'FI'=>'Finland',
                                           'FR'=>'France',
                                           'GF'=>'French Guiana',
                                           'PF'=>'French Polynesia',
                                           'TF'=>'French Southern',
                                           'GA'=>'Gabon',
                                           'GM'=>'Gambia',
                                           'GE'=>'Georgia',
                                           'DE'=>'Germany',
                                           'GH'=>'Ghana',
                                           'GI'=>'Gibraltar',
                                           'GR'=>'Greece',
                                           'GL'=>'Greenland',
                                           'GD'=>'Grenada',
                                           'GP'=>'Guadeloupe',
                                           'GU'=>'Guam',
                                           'GT'=>'Guatemala',
                                           'GG'=>'Guernsey',
                                           'GN'=>'Guinea',
                                           'GW'=>'Guinea-bissau',
                                           'GY'=>'Guyana',
                                           'HT'=>'Haiti',
                                           'HM'=>'Heard Mcdonald Island',
                                           'VA'=>'Holy See(Vatican City State)',
                                           'HN'=>'Honduras',
                                           'HK'=>'Hong Kong',
                                           'HU'=>'Hungary',
                                           'IS'=>'Iceland',
                                           'IN'=>'India',
                                           'ID'=>'Indonesia',
                                           'IR'=>'Iran, Islamic Repubtdc',
                                           'IQ'=>'Iraq',
                                           'IE'=>'Ireland',
                                           'IM'=>'Isle of Man',
                                           'IL'=>'Israel',
                                           'IT'=>'Italy',
                                           'JM'=>'Jamaica',
                                           'JP'=>'Japan',
                                           'JE'=>'Jersey',
                                           'JO'=>'Jordan',
                                           'KZ'=>'Kazakhstan',
                                           'KE'=>'Kenya',
                                           'KI'=>'Kiribati',
                                           'KP'=>'Korea',
                                           'KR'=>'Korea, Repubtdc of',
                                           'KW'=>'Kuwait',
                                           'KG'=>'Kyrgyzstan',
                                           'LA'=>'Lao People\'s Democratic Repubtdc',
                                           'LV'=>'Latvia',
                                           'LB'=>'Lebanon',
                                           'LS'=>'Lesotho',
                                           'LR'=>'tdberia',
                                           'LY'=>'tdbyan Arab Jamahiriya',
                                           'td'=>'tdechtenstein',
                                           'LT'=>'tdthuania',
                                           'LU'=>'Luxembourg',
                                           'MO'=>'Macao',
                                           'MK'=>'Macedonia',
                                           'MG'=>'Madagascar',
                                           'MW'=>'Malawi',
                                           'MY'=>'Malaysia',
                                           'MV'=>'Maldives',
                                           'ML'=>'Matd',
                                           'MT'=>'Malta',
                                           'MH'=>'Marshall Islands',
                                           'MQ'=>'Martinique',
                                           'MR'=>'Mauritania',
                                           'MU'=>'Mauritius',
                                           'YT'=>'Mayotte',
                                           'MX'=>'Mexico',
                                           'FM'=>'Micronesia',
                                           'MD'=>'Moldova',
                                           'MC'=>'Monaco',
                                           'MN'=>'Mongotda',
                                           'ME'=>'Montenegro',
                                           'MS'=>'Montserrat',
                                           'MA'=>'Morocco',
                                           'MZ'=>'Mozambique',
                                           'MM'=>'Myanmar',
                                           'NA'=>'Namibia',
                                           'NR'=>'Nauru',
                                           'NP'=>'Nepal',
                                           'NL'=>'Netherlands',
                                           'AN'=>'Netherlands Antilles',
                                           'NC'=>'New Caledonia',
                                           'NZ'=>'New Zealand',
                                           'NI'=>'Nicaragua',
                                           'NE'=>'Niger',
                                           'NG'=>'Nigeria',
                                           'NU'=>'Niue',
                                           'NF'=>'Norfolk Island',
                                           'MP'=>'Northern Mariana Islands',
                                           'NO'=>'Norway',
                                           'OM'=>'Oman',
                                           'PK'=>'Pakistan',
                                           'PW'=>'Palau',
                                           'PS'=>'Palestinian Territory, Occupied',
                                           'PA'=>'Panama',
                                           'PG'=>'Papua New Guinea',
                                           'PY'=>'Paraguay',
                                           'PE'=>'Peru',
                                           'PH'=>'Phitdppines',
                                           'PN'=>'Pitcairn',
                                           'PL'=>'Poland',
                                           'PT'=>'Portugal',
                                           'PR'=>'Puerto Rico',
                                           'QA'=>'Qatar',
                                       ], null, [ 'required' => 'required','id' =>'country' ,'class'=>'form-control']) !!}
                                   </div>
                                   <span id="errMsgUserCon" class="error-msg"></span>
                               </div>
                               
                           </fieldset>
                           <fieldset title="Account Info">
                               <legend>Account Information</legend>
                               <div class="form-group">
                                   <label class="col-md-2 col-sm-2 control-label">Username</label>
                                   <div class="col-md-6 col-sm-6">
                                       {!! Form::text('username','',['required'=>'required', 'id'=>'username', 'class'=>'form-control','placeholder'=>'Enter a username']) !!}
                                   </div>
                                   <span id="errMsgUser" class="error-msg"></span>
                               </div>
                               <div class="form-group">
                                   <label class="col-md-2 col-sm-2 control-label">Phone Number</label>
                                   <div class="col-md-6 col-sm-6">
                                       {!! Form::text('phone_number','',[ 'id'=>'phone_number' ,'class'=>'form-control','placeholder'=>'Enter a valid phone number', 'required'=>'required']) !!}
                                   </div>
                                   <span id="errMsgPhone" class="error-msg"></span>
                               </div>
                               <div class="form-group">
                                   <label class="col-md-2 col-sm-2 control-label">Email Address</label>
                                   <div class="col-md-6 col-sm-6">
                                       {!! Form::email('email','', [ 'id' => 'email','class'=>'form-control','placeholder'=>'Enter a E-mail address', 'required'=>'required']) !!}
                                   </div>
                                   <span id="errMsgEmail" class="error-msg"></span>
                               </div>
                               <div class="form-group">
                                   <label class="col-md-2 col-sm-2 control-label">Password</label>
                                   <div class="col-md-6 col-sm-6">
                                       {!! Form::password('password',[ 'required'=>'required','id'=>'password' ,'class'=>'form-control','placeholder'=>'Enter a password']) !!}
                                   </div>
                                   <span id="errMsgPass" class="error-msg"></span>
                               </div>
                               <div class="form-group">
                                   <label class="col-md-2 col-sm-2 control-label">Confirm Password</label>
                                   <div class="col-md-6 col-sm-6">
                                       {!! Form::password('re-password',[ 'required'=>'required','id'=>'rpassword' ,'class'=>'form-control','placeholder'=>'Re-enter a password']) !!}
                                   </div>
                                   <span id="errMsgRPass" class="error-msg"></span>
                               </div>
                           </fieldset>
                           <fieldset title="Referral Info">
                               <legend>Referral Information</legend>
                               <div class="form-group">
                                   <label class="col-md-2 col-sm-2 control-label">Referrar ID</label>
                                   <div class="col-md-6 col-sm-6">
                                       {!! Form::text('referrar_id','', ['required'=>'required','id'=>'referrar_id', 'class'=>'form-control','placeholder'=>'Enter your Referrar\'s ID']) !!}
                                   </div>
                                   <span id="errMsgRef" class="error-msg"></span>
                               </div>
                               <div class="form-group">
                                   <label class="col-md-2 col-sm-2 control-label">Upline ID</label>
                                   <div class="col-md-6 col-sm-6">
                                       {!! Form::text('upline_id','', ['required'=>'required','id'=>'upline_id', 'class'=>'form-control','placeholder'=>'Enter your imediate ID']) !!}
                                   </div>
                                   <span id="errMsgUp" class="error-msg"></span>
                               </div>
                               <div class="form-group">
                                   <label class="col-md-2 col-sm-2 control-label">Placement</label>
                                   <div class="col-md-6 col-sm-6">
                                       {!! Form::select('placement',[], null, ['id' => 'placement', 'class'=>'form-control']) !!}
                                   </div>
                                   <span id="errMsgRef" class="error-msg"></span>
                               </div>

                               <!-- <div class="form-group">
                                   <label class="col-md-2 col-sm-2 control-label">Text Input</label>
                                   <div class="col-md-6 col-sm-6">
                                       <input type="text" placeholder="Text Input" class="form-control">
                                   </div>
                               </div> -->
                               <!-- <div class="form-group">
                                   <label class="col-md-2 col-sm-2 control-label"></label>
                                   <div class="col-md-6 col-sm-6">
                                       <label class="checkbox">
                                           <input type="checkbox" class="icheckbox_flat-green checked" value="">
                                           I agree to the FBOC terms & conditions & privacy policy </label>
                                   </div>
                               </div> -->
                               <div class="form-group">
                                   <label class="col-md-2 col-sm-2 control-label"></label>
                                   <div class="col-md-6 col-sm-6 flat-green single-row">
                                       <label class="checkbox">
                                           <input type="checkbox" class="icheckbox_flat-green checked" value="" name="terms">
                                           </label><span class="terms">I agree to the FBOC terms & conditions & privacy policy </span>
                                   </div>
                               </div>
                               
                           </fieldset>
                           {{-- <button type="submit" class=""> Submit </button> --}}
                           {{-- <button type ="submit" class="finish btn btn-info btn-extend">Submit</button> --}}
                           <input type="submit" value="Submit" class="finish btn btn-info btn-extend">
                       {!! Form::close() !!} 
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    