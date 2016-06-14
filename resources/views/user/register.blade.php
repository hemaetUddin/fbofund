@extends('layouts.adminMaster')



@section('style')

	{{-- <link href="css/style.css" rel="stylesheet"> --}}

	{!! Html::style('/css/jquery.stepy.css') !!}

	{!! Html::style('/css/custom.css') !!}

	{!! Html::style('/js/iCheck/skins/flat/green.css') !!}

	{{-- <link href="css/style-responsive.css" rel="stylesheet"> --}}



@stop



@section('body-content')

	    

	    

	  

	      <div class="col-md-8">

	      	<div class="row">

	      	@include('depoMsg')

	      	@include('errMsg')

	      		@if (count($errors) > 0)

	      		    {{-- <div class="alert alert-danger"> --}}

	      		        <ul>

	      		            @foreach ($errors->all() as $error)

							<div class="alert alert-danger fade in">

								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

								<li class="userRegErr">{{ $error }}</li>

							</div>	      		                

	      		            @endforeach

	      		        </ul>

	      		    {{-- </div> --}}

	      		@endif

	      		

	      	</div>

			<div class="row">

			    <div class="col-md-12">

			        <div class="panel panel-info">

			            <div class="panel-heading">

			                New member registration

			                <span class="tools pull-right">

			                    {{-- <a href="javascript:;" class="fa fa-chevron-down"></a> --}}

			                    {{-- <a href="javascript:;" class="fa fa-times"></a> --}}

			                 </span>

			            </div>

			            <div class="panel-body">

			                {{-- ---------------------- --}}



							          <div class="square-widget">

							              <div class="widget-container">

							                  <div class="stepy-tab">

							                  </div>

							                  {{-- <form id="default" class="form-horizontal"> --}}

							                  {!! Form::open(['url'=>'user/store', 'class'=>'form-horizontal']) !!}

							                  {!! Form::hidden('userId', Auth::user()->id, ['id'=>'userId']) !!}

							                      <fieldset title="Basic Info">

							                          <div class="row">

							                          	<div class="col-md-8">

							                          		<div class="form-heading">Personal Information</div>

							                          	</div>

							                          </div>

							                          <div class="form-group">

							                              <label class="col-md-2 col-sm-2 control-label">Full Name</label>

							                              <div class="col-md-6 col-sm-6">

								                              <div class="input-group">

								                                <div class="input-group-addon"><i class="fa fa-user-secret"></i></div>

								                                {!! Form::text('full_name','',['id' => 'full_name' ,'class'=>'form-control','placeholder'=>'Enter your full name', 'required' => 'required']) !!}

								                              </div>

								                              <span id="errMsgUserFull" class="error-msg"></span>

							                              </div>

							                            </div>



							                            <div class="form-group">

							                              <label class="col-md-2 col-sm-2 control-label">Address 1</label>

							                              <div class="col-md-6 col-sm-6">

								                              <div class="input-group">

								                                <div class="input-group-addon"><i class="fa fa-road"></i></div>

								                                {!! Form::text('address1','',['id' => 'address1' ,'class'=>'form-control','placeholder'=>'Enter Address ']) !!}

								                              </div>

								                              <span id="errMsgUserAdd" class="error-msg"></span>

							                              </div>

							                            </div>



							                            <div class="form-group">

							                              <label class="col-md-2 col-sm-2 control-label">Address 2</label>

							                              <div class="col-md-6 col-sm-6">

								                              <div class="input-group">

								                                <div class="input-group-addon"><i class="fa fa-road"></i></div>

								                                {!! Form::text('address2','',['class'=>'form-control','placeholder'=>'Enter Address']) !!}

								                              </div>

							                              </div>

							                            </div>



							                            <div class="form-group">

							                              <label class="col-md-2 col-sm-2 control-label">Gender</label>

							                              <div class="col-md-6 col-sm-6">

								                              <div class="input-group">

								                                <div class="input-group-addon"><i class="fa fa-male"></i>/<i class="fa fa-female"></i></div>

								                                {!! Form::select('gender',[

								                                '' => '--Select your gender',

								                                'male'=>'Male',

								                                'female'=>'Female'], null, ['id'=>'gender','class'=>'form-control']) !!}

								                              </div>

								                              <span id="errMsgUserGen" class="error-msg"></span>

							                              </div>

							                            </div>



							                            <div class="form-group">

							                              <label class="col-md-2 col-sm-2 control-label">Country</label>

							                              <div class="col-md-6 col-sm-6">

								                              <div class="input-group">

								                                <div class="input-group-addon"><i class="fa fa-globe"></i></div>

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

								                                ], null, [ 'id' =>'country' ,'class'=>'form-control']) !!}

								                              </div>

								                              <span id="errMsgUserCon" class="error-msg"></span>

							                              </div>

							                            </div>

							                          

							                      </fieldset>

							                      <fieldset title="Account Info">

							                          <div class="row">

							                          	<div class="col-md-8">

							                          		<div class="form-heading">Account Information</div>		

							                          	</div>

							                          </div>

							                          



							                          <div class="form-group">

							                              <label class="col-md-2 col-sm-2 control-label">Username</label>

							                              <div class="col-md-6 col-sm-6">

								                              <div class="input-group">

								                                <div class="input-group-addon"><i class="fa fa-user"></i></div>

								                                {!! Form::text('username','',['id'=>'username', 'class'=>'form-control','placeholder'=>'Enter a username', 'required' => 'required' ]) !!}

								                              </div>

								                              <span id="errMsgUser" class="error-msg"></span>

							                              </div>

							                            </div>



							                            <div class="form-group">

							                              <label class="col-md-2 col-sm-2 control-label">Phone Number</label>

							                              <div class="col-md-6 col-sm-6">

								                              <div class="input-group">

								                                <div class="input-group-addon"><i class="fa fa-mobile"></i></div>

								                                {!! Form::text('phone_number','',[ 'id'=>'phone_number' ,'class'=>'form-control','placeholder'=>'Enter a valid phone number', 'required'=>'required']) !!}

								                              </div> 

								                              <span id="errMsgPhone" class="error-msg"></span>

								                              <span id="errMsgUserPhone2" class="error-msg"></span>

							                              </div>

							                            </div> 



							                            <div class="form-group">

							                              <label class="col-md-2 col-sm-2 control-label">Email</label>

							                              <div class="col-md-6 col-sm-6">

								                              <div class="input-group">

								                                <div class="input-group-addon"><i class="fa fa-at"></i></div>

								                                {!! Form::email('email','', [ 'id' => 'email','class'=>'form-control','placeholder'=>'Enter a E-mail address', 'required'=>'required']) !!}

								                              </div>

								                              <span id="errMsgEmail" class="error-msg"></span>

							                              </div>

							                            </div>



							                            <div class="form-group">

							                              <label class="col-md-2 col-sm-2 control-label">Password</label>

							                              <div class="col-md-6 col-sm-6">

								                              <div class="input-group">

								                                <div class="input-group-addon"><i class="fa fa-lock"></i></div>

								                                {!! Form::password('password',[ 'id'=>'password' ,'class'=>'form-control','placeholder'=>'Enter a password']) !!}

								                              </div>

								                              <span id="errMsgPass" class="error-msg"></span>

							                              </div>

							                            </div>



							                            <div class="form-group">

							                              <label class="col-md-2 col-sm-2 control-label">Confirm Password</label>

							                              <div class="col-md-6 col-sm-6">

								                              <div class="input-group">

								                                <div class="input-group-addon"><i class="fa fa-lock"></i></div>

								                                {!! Form::password('re-password',[ 'id'=>'rpassword' ,'class'=>'form-control','placeholder'=>'Re-enter a password']) !!}

								                              </div>

								                              <span id="errMsgRPass" class="error-msg"></span>

							                              </div>

							                            </div>

							                      </fieldset>



							                      <fieldset title="Referral Info">

							                          <div class="row">

							                          	<div class="col-md-8">

							                          		<div class="form-heading">Referral Information</div>

							                          	</div>

							                          </div>



							                          <div class="form-group">

							                              <label class="col-md-2 col-sm-2 control-label">Referrar ID</label>

							                              <div class="col-md-6 col-sm-6">

								                              <div class="input-group">

								                                <div class="input-group-addon"><i class="fa fa-user"></i></div>

								                                {!! Form::text('referrar_id','', ['id'=>'referrar_id', 'class'=>'form-control','placeholder'=>'Enter your Referrar\'s ID']) !!}

								                              </div>

								                              <span id="errMsgRef" class="error-msg"></span>

							                              </div>

							                            </div>



							                            <div class="form-group">

							                              <label class="col-md-2 col-sm-2 control-label">Upper Lavel ID</label>

							                              <div class="col-md-6 col-sm-6">

								                              <div class="input-group">

								                                <div class="input-group-addon"><i class="fa fa-lock"></i></div>

								                                {{-- <input type="text" class="form-control" id="exampleInputAmount" placeholder=""> --}}

								                                {!! Form::text('upline_id','', ['id'=>'upline_id', 'class'=>'form-control','placeholder'=>'Enter your imediate ID']) !!}

								                              </div> 

								                              <span id="errMsgUp" class="error-msg"></span>

							                              </div>

							                            </div>



							                            <div class="form-group">

							                              <label class="col-md-2 col-sm-2 control-label">Placement</label>

							                              <div class="col-md-6 col-sm-6">

								                              <div class="input-group">

								                                <div class="input-group-addon"><i class="fa fa-sitemap"></i></div>

								                                {!! Form::select('placement',[], null, ['id' => 'placement', 'class'=>'form-control']) !!}

								                                {{-- <select id="placement" class="form-control" name="placement"></select> --}}

								                              </div>

							                              </div>

							                            </div>

							                            <div class="form-group">

							                              <label class="col-md-2 col-sm-2 control-label"></label>

							                              <div class="col-md-6 col-sm-6">

								                              <div class="input-group">

								                                {{-- <div class="input-group-addon"><i class="fa fa-sitemap"></i></div> --}}

								                                <label><input type="checkbox" class="terms" name="check" id="check" required="required"> 

								                                &nbsp;&nbsp; I agree to the FBOC terms & conditions and privacy policy</label>

								                              </div>

							                              </div>

							                            </div>



							                            



							                            {{-- <div class="form-group">

							                              <label class="col-md-2 col-sm-2 control-label">Package</label>

							                              <div class="col-md-6 col-sm-6">

								                              <div class="input-group">

								                                <div class="input-group-addon"><i class="fa fa-sitemap"></i></div>

								                                {!! Form::select('package',[

								                                '' => '--Select--',

								                                '300'	=> '$ 300',

								                                '700'	=> '$ 700',

								                                '1000' 	=> '$ 1000',

								                                '2000' 	=> '$ 2000',

								                                '4000' 	=> '$ 4000',

								                                '10000' => '$ 10000',], null, ['id' => 'package', 'class'=>'form-control']) !!}

								                              </div>

							                              </div>

							                            </div> --}}

							                      </fieldset>

							                      <!-- <fieldset title="Final Step">

							                          <div>Final Step Information</div>

							                          <div class="form-group">

							                              <div class="col-md-12">

							                                  <p>Congratulations This is the Final Step</p>

							                              </div>

							                          </div>

							                      </fieldset> -->

							                      <div class="btn-div">

							                       		<button class="btn btn-info testClass text-center"> Submit </button>

							                      </div>

							                  </form>

							                 

							              </div>

							          </div>



			                {{-- ------------------------------ --}}

								

										<div class="row">

											<div class="col-md-8">

												<div class="" id="terms" class="form-heading">

												    <a href="javascript:void(0)"><span><i class="fa fa-plus"></i> Read Terms &amp; Conditions</span></a>

												</div>

											</div>

											<div id="terms-details">

											    <h5>FBOC Terms and Conditions:</h5>

											    

											    <p>This User Agreement describes the terms and conditions on which you are allowed to use our Website and our Services.</p>



											    <p>Please take the time to read and understand the Terms and Conditions.</p>



											    <p>By accessing and/or using the Website, you agree to the following terms with FBOC.

											    We may amend this User Agreement and any linked information from time to time by posting amended terms on the Website.</p>

											    <p>You must read and accept all of the terms in and linked to, this User Agreement, the Code of Conduct the FBOC Privacy Policy and all Website policies. We strongly recommend that, as you read this User Agreement, you also access and read the hyperlinked information. By accepting this User Agreement, you agree that this User Agreement will apply whenever you use the FBOC Website, or when you use the tools we make available to interact with the FBOC Website. 

											    

											    <h5>Terms of Participation:</h5>



											    <p>By opening an account with us you automatically state that you have read, fully understood, accept and agree to abide by our Terms and Conditions when using our services.</p>



											    <p>Member must be 18 years of age or older to participate. Members must provide FBOC with accurate, complete and updated Registration information, including an accurate name, contact number and email address.</p>



											    <p>By signing up for the FBOC program, Member is opting-in to receive other special offer emails from FBOC. If you do not wish to receive these emails, you may cancel your account anytime.</p>



											    <p>FBOC reserves the right to track Member's activity by both IP Address as well as individual browser activity. FBOC has the right, in its sole discretion, to suspend or cancel, at any time and for any or no reason. All Earnings may be cancelled in FBOC sole discretion.</p>



											    <p>Member agrees not to abuse his or her membership privileges by acting in a manner inconsistent with this Agreement.</p>



											    <p>Member agrees not to posting any negative comment or marks in any website online without contacting the admin first.</p>



											    <p>FBOC shall be the sole determiner in cases of suspected abuse, fraud, or violation of its rules. </p>



											    <p>FBOC makes relating to the cancellation of Earnings and the termination of membership shall be final and binding.</p>



											    <h5>FBOC Privacy Policy</h5>



											    FBOC has created this privacy policy in order to demonstrate our firm commitment to privacy. The following discloses the information gathering and dissemination practices for the FBOC site.

											    <p>By using the FBOC site and accepting the User Agreement you also agree to this Privacy Policy. If you do not agree to this Privacy Policy, you must not use the FBOC site. The terms "We," "Us," "Our," or "FBOC" includes our affiliates.</p>

											

											    <p>FBOC strives to offer its visitors the many advantages of Internet technology and to provide an interactive and personalized experience. We may use Personally Identifiable Information (your name, e-mail address, Contact address, Phone number) subject to the terms of this privacy policy. We will never sell, barter, or rent your email address to any unauthorized third party. WE HATE SPAM! We NEVER sell, rent, barter or share your Email Address with anyone. However we collect and store information depends on the page you are visiting, the activities in which you elect to participate and the services provided.</p>



											    <h5>Anti-Spam Policy:</h5>



											    Our attitude towards spam is zero-tolerance. Any members caught spamming will be suspended and deleted from the database. Active portfolios will be closed. 

											   <p> Members can use their referral link or any promotional tools provided in the website to advertise and other advertisements not will be prohibited without any approval or consent form the administration.

											    Intellectual Property:</p>



											    <p>All intellectual property rights in this website including without limit all text, graphics, images, software and any other materials is owned by FBOC. The materials on this website must only be used for your own personal use and solely for non-commercial purposes. You may display on a computer screen or print extracts from this website for the above-stated purpose only and without alteration, addition or deletion.</p>



											    <h5>Password Protection:</h5>



											    You are aware not to disclose your password to access your account to any third party.

											    Your login password should contain not less than 6 symbols and should include both numbers and letters only.

											    Do not lose your Password you may not able to recover your account. Keep it secured and safe somewhere where no one can have access to it.



											   <p> You are solely responsible for maintaining the confidentiality of the Membership Account, Login Password. FBOC will not be liable for any loss or damage arising from your failure to comply with this section.</p>



											    <h5>“General Terms”</h5>



											    <p>Registration, Passwords and Security: </p>



											    <p>In order to use certain Services and to access the Member's Area, FBOC requires that you register. By registering, you agree to: (a) provide true, accurate, current and complete information about yourself as prompted by the applicable registration form(s); and (b) maintain and promptly update the information. If you provide any information that is untrue, inaccurate, not current or incomplete, or FBOC, has any grounds to suspect that such information is untrue, inaccurate, not current or incomplete, FBOC has the exclusive right to refuse you any current or future use or access to the Service, Member's Area or any portion thereof.</p>



											    <h5>Copyright</h5>



											    FBOC is the owner of all of the intellectual property and rights of this website, including its entire published content. This website is protected by copyrights and all of the rights are reserved. The contents of our website are intended solely for the use of our website's visitors.

											    <p>The reproduction, modification, distribution, transmission, republication, display or performance of the contents of this website is strictly prohibited without prior written permission from FBOC.</p>



											    <h5>Disclaimer: </h5>



											    FBOC shall not be liable for any losses arising from failure of the Investor to hold his PC systems free from malicious software used by third parties to get unauthorized access to Investors account. It is Investors sole responsibility to manage their password.



											   <p> The Investor agrees to hold the Company harmless of any liability regarding possible loss of Investors funds during investment process. The Investor understands that he is participating and investing in the program at his own risk.<p>



											    <p>FBOC reserves the right to modify Terms and Conditions at any time. You should check Terms and Conditions periodically for changes. By using this site after we post any changes to these terms and conditions, you agree to accept those changes, whether or not you have reviewed them. If at any time you choose not to accept these terms and conditions of use please do not use this site.</p>

											     

											    <h5>Changes to our privacy policy:</h5>

											    We may change this privacy policy from time to time. Any updated versions of this privacy policy will be posted on our website. Please review it regularly.



											</div>

										</div>	          

								      </div>



	



			            </div>

			        </div>

			    </div>

			</div>

			



	  



	  <div class="col-md-4">

	  	@include('partials.right-sidebar')

	  </div> 







	    

@stop



@section('script')

	{{-- // <script src="/"></script> --}}

	

	{!! Html::script('js/custom/userRegister.js') !!}

	{!! Html::script('js/jquery.stepy.js') !!}

	

	{{-- {!! Html::script('js/jquery-1.10.2.min.js') !!} --}}

	{{-- {!! Html::script('js/jquery-ui-1.9.2.custom.min.js') !!} --}}

	{{-- {!! Html::script('js/jquery-migrate-1.2.1.min.js') !!} --}}

	{{-- {!! Html::script('js/bootstrap.min.js') !!} --}}

	{{-- {!! Html::script('js/modernizr.min.js') !!} --}}

	{{-- {!! Html::script('js/jquery.nicescroll.js') !!} --}}

	{!! Html::script('js/jquery.validate.min.js') !!}

	{!! Html::script('js/validation-init.js') !!}

	<!--icheck -->





	

	<script>

	$(document).ready(function(){

		$('#terms').click(function(){

			// e.preventdefault();

			$('#terms-details').slideToggle();

		});

	});



	    /*=====STEPY WIZARD====*/

	    $(function() {

	        $('#default').stepy({

	            backLabel: 'Previous',

	            block: true,

	            nextLabel: 'Next',

	            titleClick: true,

	            titleTarget: '.stepy-tab'

	        });

	    });

	    /*=====STEPY WIZARD WITH VALIDATION====*/

	    $(function() {

	        $('#stepy_form').stepy({

	            backLabel: 'Back',

	            nextLabel: 'Next',

	            errorImage: true,

	            block: true,

	            description: true,

	            div: false,

	            titleClick: true,

	            titleTarget: '#top_tabby',

	            validate: true

	        });

	        $('#stepy_form').validate({

	            errorPlacement: function(error, element) {

	                $('#stepy_form div.stepy-error').append(error);

	            },

	            rules: {

	            	'name': 'required',

	                'fullname':'required',

	                'email': 'required',

	            },

	            messages: {

	            	'name': {

	                    required: 'Name field is required!'

	                },

	                'email': {

	                    required: 'Email field is requerid!'

	                },

	                'fullname': {

	                    required: 'Full name field is required!'

	                }

	            }

	        });

	    });

	</script>   

@stop