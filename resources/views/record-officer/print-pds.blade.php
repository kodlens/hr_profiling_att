<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Personal Data Sheet</title>
	<link rel="stylesheet" href="/css/bootstrap.min.css">
	<link rel="stylesheet" href="/css/pds-style.css">
</head>
<body>
	<div class="table-responsive p-3">

		<form action="">
			<table id="pds-table">

				<tbody class="table-header">
					<tr>
						<td colspan="12" class="h5"><i><b>CS Form No. 212</b></i></td>
					</tr>
					<tr>
						<td colspan="12" class="align-top" style="max-height: 12px;">
							<i><b>Revised 2017</b></i>
						</td>
					</tr>
					<tr>
						<td colspan="12" class="text-center"><h1><b>PERSONAL DATA SHEET</b></h1></td>
					</tr>
					<tr>
						<td colspan="12"><i><b>WARNING: Any misrepresentation main in the Personal Data Sheet and the Work Experience Sheet shall cause the filing of administative/criminal case/s against the person concerned.</b></i></td>
					</tr>
					<tr>
						<td colspan="12"><i><b>READ THE ATTACHED GUIDE TO FILLING OUT THE PERSONAL DATA SHEET (PDS) BEFORE ACCOMPLISHING THE PDS FORM</b></i></td>
					</tr>
					<tr>
						<td colspan="9">Print legibly. Tick appropriate boxes ( <input type="checkbox" checked> ) ad use seperate sheet if necessary. Indicate N/A if not applicable. <b>DO NOT ABBREVIATE.</b></td>
						<td colspan="1" style="border:1px solid#000b;background:#757575;width:8%;"><small>1. CS ID No.</small></td>
						<td colspan="2" class="text-right" style="border:1px solid #000;width:20%;"><small>(Do not fill up. For CSC use only)</small></td>
					</tr>
				</tbody>

				<tbody class="table-body">
					<tr>
						<td colspan="12" class="text-white separator">I. PERSONAL INFORMATION</td>
					</tr>
					<tr>
						<td colspan="1" class="s-label border-bottom-0">
							<span class="count">2.</span> SURNAME
						</td>
						<td colspan="11">{{ $user->lname }}</td>
					</tr>
					<tr>
						<td colspan="1" class="s-label border-0"><span class="count"></span> FIRST NAME</td>
						<td colspan="9">{{ $user->fname }}</td>
						<td colspan="2" class="align-top"><small>NAME EXTENSION (JR.,SR) {{ $user->suffix }}</small></td>
					</tr>
					<tr>
						<td colspan="1" class="s-label border-0"><span class="count"></span> MIDDLE NAME</td>
						<td colspan="11">{{ $user->middlename }}</td>
					</tr>
					<tr>
						<td colspan="1" class="s-label border-bottom-0">
							<span class="count">3.</span> DATE OF BIRTH<br>
							<span class="count"></span> (mm/dd/yyyy)
						</td>
						<td colspan="5">@php echo date('m/d/Y', strtotime($user->date_birth)); @endphp</td>
						<td colspan="3" class="s-label align-top border-bottom-0">
							<span class="count">16.</span> CITIZENSHIP
						</td>
						<td colspan="3">
							{{$user->citizenship}}
						</td>
					</tr>
					<tr>
						<td colspan="1" class="s-label border-0"></td>
						<td colspan="5"></td>
						<td colspan="3" class="s-label align-top border-0 text-center small">
							If holder of dual citizenship,
						</td>
						<td colspan="3">
						</td>
					</tr>
					<tr>
						<td colspan="1" class="s-label"><span class="count">4.</span> PLACE OR BIRTH</td>
						<td colspan="5">{{ $user->place_birth }}</td>
						<td colspan="3" class="s-label align-top border-0 text-center small"> please indicate the details.</td>
						<td colspan="3"></td>
					</tr>
					<tr>
						<td colspan="1" class="s-label"><span class="count">5.</span> SEX</td>
						<td colspan="5">{{$user->sex}}</td>
						<td colspan="3" class="s-label align-top border-0"></td>
						<td colspan="3"></td>
					</tr>
					<tr>
						<td colspan="1" class="s-label border-bottom-0"><span class="count">6.</span> CIVIL STATUS</td>
						<td colspan="5">{{$user->civil_status}}</td>
						<td colspan="2" class="s-label align-top border-bottom-0 small">
							<span class="count">17.</span> RESIDENTIAL ADDRESS
						</td>
						<td colspan="2">
							@if($user->residential_province)
								<span>{{$user->residential_province->provDesc}}</span>
							@endif	
						</td>
						<td colspan="2">
							@if($user->residential_city)
								<span>{{$user->residential_city->citymunDesc}}</span>
								@endif	
							</td>
					</tr>
					<tr>
						<td colspan="1" class="s-label border-top-0"><span class="count"></span></td>
						<td colspan="5"></td>
						<td colspan="2" class="s-label align-top border-0"></td>
						<td colspan="2">
							@if($user->residential_barangay)
								<span>{{$user->residential_barangay->brgyDesc}}</span>
								@endif	
							</td>	
						</td>
						<td colspan="2">{{$user->res_street}}</td>
					</tr>
					<tr>
						<td colspan="1" class="s-label"><span class="count">7.</span> HEIGHT (m)</td>
						<td colspan="5">{{$user->height}} M</td>
						<td colspan="2" class="s-label align-top border-0"></td>
						<td colspan="2"></td>
					</tr>
					<tr>
						<td colspan="1" class="s-label"><span class="count">8.</span> WEIGHT (kg)</td>
						<td colspan="5">{{$user->weight}} KG</td>
						<td colspan="2" class="s-label border-0 text-center">
							ZIP CODE
						</td>
						<td colspan="4">{{$user->res_zipcode}}</td>
					</tr>
					<tr>
						<td colspan="1" class="s-label"><span class="count">9.</span> BLOOD TYPE</td>
						<td colspan="5">{{$user->blood_type}}</td>
						<td colspan="2" class="s-label border-bottom-0"><span class="count">18.</span> PERMANENT ADDRESS</td>
						<td colspan="2">@isset($user->permanent_province) {{$user->permanent_province->provDesc}} @endisset</td>
						<td colspan="2">@isset($user->permanent_city) {{$user->permanent_city->citymunDesc}} @endisset</td>
					</tr>
					<tr>
						<td colspan="1" class="s-label"><span class="count">10.</span> GSIS ID NO.</td>
						<td colspan="5">{{$user->gsis}}</td>
						<td colspan="2" class="s-label border-0"></td>
						<td colspan="2">@isset($user->permanent_barangay) {{$user->permanent_barangay->brgyDesc}} @endisset</td>
						<td colspan="2">{{$user->per_street}}</td>
					</tr>
					<tr>
						<td colspan="1" class="s-label"><span class="count">11.</span> PAG-IBIG NO.</td>
						<td colspan="5">{{$user->pagibig}}</td>
						<td colspan="2" class="s-label border-0"></td>
						<td colspan="2">{{$user->per_zipcode}}</td>
						<td colspan="2"></td>
					</tr>
					<tr>
						<td colspan="1" class="s-label"><span class="count">12.</span> PHILHEALTH NO.</td>
						<td colspan="5">{{$user->philhealth}}</td>
						<td colspan="2" class="s-label text-center border-0">ZIP CODE</td>
						<td colspan="4"></td>
					</tr>
					<tr>
						<td colspan="1" class="s-label"><span class="count">13.</span> SSS NO.</td>
						<td colspan="5">{{$user->sss}}</td>
						<td colspan="2" class="s-label"><span class="count">19.</span> TELEPHONE NO.</td>
						<td colspan="4">{{$user->tel_no}}</td>
					</tr>
					<tr>
						<td colspan="1" class="s-label"><span class="count">14.</span> TIN NO.</td>
						<td colspan="5">{{$user->tin}}</td>
						<td colspan="2" class="s-label"><span class="count">20.</span> MOBILE NO.</td>
						<td colspan="4">{{$user->contact_no}}</td>
					</tr>
					<tr>
						<td colspan="1" class="s-label"><span class="count">15.</span> AGENCY EMPLOYEE NO.</td>
						<td colspan="5">{{$user->agency_no}}</td>
						<td colspan="2" class="s-label"><span class="count">21.</span> EMAIL ADDRESS (if any)</td>
						<td colspan="4">{{$user->email}}</td>
					</tr>
				</tbody>

				<tbody class="table-body">
					<tr>
						<td colspan="12" class="text-white separator">II. FAMILY BACKGROUND</td>
					</tr>
					<tr>
						<td colspan="1" class="s-label border-bottom-0">
							<span class="count">22.</span> SPOUSE SURNAME
						</td>
						<td colspan="5">{{$user->spouse_surname}}</td>
						<td colspan="3" class="s-label">
							<span class="count">23.</span> NAME of CHILDREN (Write full name and list all)
						</td>
						<td colspan="3" class="s-label text-center" style="width: 18%;">DATE OF BIRTH (mm/dd/yyyy)</td>
					</tr>
					<tr>
						<td colspan="1" class="s-label border-0">
							<span class="count"></span> FIRST NAME
						</td>
						<td colspan="4">{{$user->spouse_fname}}</td>
						<td colspan="1" class="align-top s-label">
							<small>
								NAME EXTENSION (JR.,SR)
							</small>
						</td>
						<td colspan="3">
							@if(isset($user->children[0]))
								{{ $user->children[0]->fullname}}
							@endisset
						</td>
						<td colspan="3">
							@if(isset($user->children[0]))
								{{ date('m-d-Y', strtotime($user->children[0]->child_bdate)) }}
							@endisset
						</td>
					</tr>
					<tr>
						<td colspan="1" class="s-label border-0">
							<span class="count"></span> MIDDLE NAME
						</td>
						<td colspan="5">{{$user->spuse_mname}}</td>
						<td colspan="3">
							@if(isset($user->children[1]))
								{{ $user->children[1]->fullname}}
							@endisset</td>
						<td colspan="3">
							@if(isset($user->children[1]))
								{{ date('m-d-Y', strtotime($user->children[1]->child_bdate)) }}
							@endisset
						</td>
					</tr>
					<tr>
						<td colspan="1" class="s-label">
							<span class="count"></span> OCCUPATION
						</td>
						<td colspan="5">{{$user->spouse_occupation}}</td>
						<td colspan="3">
							@if(isset($user->children[2]))
								{{ $user->children[2]->fullname}}
							@endisset</td>
						<td colspan="3">
							@if(isset($user->children[2]))
								{{ date('m-d-Y', strtotime($user->children[2]->child_bdate)) }}
							@endisset
						</td>
					</tr>
					<tr>
						<td colspan="1" class="s-label">
							<span class="count"></span> EMPLOYER/BUSINESS NAME
						</td>
						<td colspan="5">{{$user->business_name}}</td>
						<td colspan="3">
							@if(isset($user->children[3]))
								{{ $user->children[3]->fullname}}
							@endisset</td>
						<td colspan="3">
							@if(isset($user->children[3]))
								{{ date('m-d-Y', strtotime($user->children[3]->child_bdate)) }}
							@endisset
						</td>
					</tr>
					<tr>
						<td colspan="1" class="s-label">
							<span class="count"></span> BUSINESS ADDRESS
						</td>
						<td colspan="5">{{$user->business_address}}</td>
						<td colspan="3">
							@if(isset($user->children[4]))
								{{ $user->children[4]->fullname}}
							@endisset</td>
						<td colspan="3">
							@if(isset($user->children[4]))
								{{ date('m-d-Y', strtotime($user->children[4]->child_bdate)) }}
							@endisset
						</td>
					</tr>
					<tr>
						<td colspan="1" class="s-label">
							<span class="count"></span> TELEPHONE NO.
						</td>
						<td colspan="5">{{$user->business_contact_no}}</td>
						<td colspan="3">
							@if(isset($user->children[5]))
								{{ $user->children[5]->fullname}}
							@endisset</td>
						<td colspan="3">
							@if(isset($user->children[5]))
								{{ date('m-d-Y', strtotime($user->children[5]->child_bdate)) }}
							@endisset
						</td>
					</tr>
					<tr>
						<td colspan="1" class="s-label border-bottom-0">
							<span class="count">24.</span> FATHER'S SURNAME
						</td>
						<td colspan="5">{{$user->father_surname}}</td>
						<td colspan="3">
							@if(isset($user->children[6]))
								{{ $user->children[6]->fullname}}
							@endisset</td>
						<td colspan="3">
							@if(isset($user->children[6]))
								{{ date('m-d-Y', strtotime($user->children[6]->child_bdate)) }}
							@endisset
						</td>
					</tr>
					<tr>
						<td colspan="1" class="s-label border-0">
							<span class="count"></span> FIRST NAME
						</td>
						<td colspan="4">{{$user->father_fname}}</td>
						<td colspan="1" class="align-top s-label">
							<small>
								NAME EXTENSION (JR.,SR)
							</small>
						</td>
						<td colspan="3">
							@if(isset($user->children[7]))
								{{ $user->children[7]->fullname}}
							@endisset</td>
						<td colspan="3">
							@if(isset($user->children[7]))
								{{ date('m-d-Y', strtotime($user->children[7]->child_bdate)) }}
							@endisset
						</td>
					</tr>
					<tr>
						<td colspan="1" class="s-label border-0">
							<span class="count"></span> MIDDLE NAME
						</td>
						<td colspan="5">{{$user->father_mname}}</td>
						<td colspan="3">
							@if(isset($user->children[8]))
								{{ $user->children[8]->fullname}}
							@endisset</td>
						<td colspan="3">
							@if(isset($user->children[8]))
								{{ date('m-d-Y', strtotime($user->children[8]->child_bdate)) }}
							@endisset
						</td>
					</tr>
					<tr>
						<td colspan="1" class="s-label border-bottom-0">
							<span class="count">25.</span> MOTHERS MAIDEN NAME
						</td>
						<td colspan="5"></td>
						<td colspan="3">
							@if(isset($user->children[9]))
								{{ $user->children[9]->fullname}}
							@endisset</td>
						<td colspan="3">
							@if(isset($user->children[9]))
								{{ date('m-d-Y', strtotime($user->children[9]->child_bdate)) }}
							@endisset
						</td>
					</tr>
					<tr>
						<td colspan="1" class="s-label border-0">
							<span class="count"></span> SURNAME
						</td>
						<td colspan="5">{{$user->mother_maiden_name}}</td>
						<td colspan="3">
							@if(isset($user->children[10]))
								{{ $user->children[10]->fullname}}
							@endisset</td>
						<td colspan="3">
							@if(isset($user->children[10]))
								{{ date('m-d-Y', strtotime($user->children[10]->child_bdate)) }}
							@endisset
						</td>
					</tr>
					<tr>
						<td colspan="1" class="s-label border-0">
							<span class="count"></span> FIRST NAME
						</td>
						<td colspan="5">{{$user->mother_fname}}</td>
						<td colspan="3">
							@if(isset($user->children[11]))
								{{ $user->children[11]->fullname}}
							@endisset</td>
						<td colspan="3">
							@if(isset($user->children[11]))
								{{ date('m-d-Y', strtotime($user->children[11]->child_bdate)) }}
							@endisset
						</td>
					</tr>
					<tr>
						<td colspan="1" class="s-label border-0">
							<span class="count"></span> MIDDLE NAME
						</td>
						<td colspan="5">{{$user->mother_mname}}</td>
						<td colspan="6" class="s-label text-danger text-center"><i><b>(Continue on seperate sheet if necessary)</b></i></td>
					</tr>
				</tbody>

				<tbody class="table-body">
					<tr>
						<td colspan="12" class="text-white separator">III. EDUCATIONAL BACKGROUND</td>
					</tr>
					<tr class="text-center">
						<td colspan="1" class="s-label border-bottom-0">
							<span class="count">26.</span>
							<span class="d-block text-center">LEVEL</span>
						</td>
						<td colspan="4" class="s-label border-bottom-0">
							NAME OF SCHOOL<br>(Write in full)
						</td>
						<td colspan="2" class="s-label border-bottom-0">
							BASIC EDUCATION/DEGREE/COURSE<br>
							(Write in full)
						</td>
						<td colspan="2" class="s-label border-bottom-0">
							PERIOD OF ATTENDANCE
						</td>
						<td colspan="1" class="s-label border-bottom-0">HIGHEST LEVEL/UNITS EARNED<br>(If not graduated)</td>
						<td colspan="1" class="s-label border-bottom-0">YEAR GRADUATED</td>
						<td colspan="1" class="s-label border-bottom-0">SCHOLARSHIP/<br>ACADEMIC<br>HONORS<br>RECEIVED</td>
					</tr>
					<tr class="text-center" style="margin-top: -20px;">
						<td colspan="1" class="s-label border-top-0"></td>
						<td colspan="4" class="s-label border-top-0"></td>
						<td colspan="2" class="s-label border-top-0"></td>
						<td colspan="1" class="s-label">From</td>
						<td colspan="1" class="s-label">To</td>
						<td colspan="1" class="s-label border-top-0"></td>
						<td colspan="1" class="s-label border-top-0"></td>
						<td colspan="1" class="s-label border-top-0"></td>
					</tr>
					<tr>
						<td colspan="1" class="s-label">
							<span class="count"></span> ELEMENTARY
						</td>
						<td colspan="4">
							@if(isset($user->educational_backgrounds[0]))
								{{ $user->educational_backgrounds[0]->name_of_school}}
							@endisset
						</td>
						<td colspan="2"></td>
						<td colspan="1"></td>
						<td colspan="1">
							@if(isset($user->educational_backgrounds[0]))
								{{$user->educational_backgrounds[0]->period_att_from}}
							@endisset
						</td>
						<td colspan="1">
							@if(isset($user->educational_backgrounds[0]))
								{{$user->educational_backgrounds[0]->period_att_to}}
							@endisset
						</td>
						<td colspan="1">
							@if(isset($user->educational_backgrounds[0]))
							{{date('Y/m/d', strtotime($user->educational_backgrounds[0]->year_graduated))}}
							@endisset
						</td>
						<td colspan="1"></td>
					</tr>
					<tr>
						<td colspan="1" class="s-label">
							<span class="count"></span> SECONDARY
						</td>
						<td colspan="4">
							@if(isset($user->educational_backgrounds[1]))
								{{ $user->educational_backgrounds[1]->name_of_school}}
							@endisset
						</td>
						<td colspan="2"></td>
						<td colspan="1"></td>
						<td colspan="1">
							@if(isset($user->educational_backgrounds[1]))
								{{$user->educational_backgrounds[1]->period_att_from}}
							@endisset
						</td>
						<td colspan="1">
							@if(isset($user->educational_backgrounds[1]))
								{{$user->educational_backgrounds[1]->period_att_to}}
							@endisset
						</td>
						<td colspan="1">
							@if(isset($user->educational_backgrounds[1]))
							{{date('Y/m/d', strtotime($user->educational_backgrounds[1]->year_graduated))}}
							@endisset
						</td>
						<td colspan="1"></td>
					</tr>
					<tr>
						<td colspan="1" class="s-label">
							<span class="count"></span> VOCATIONAL/<br>
							<span class="count"></span> TRADE COURSE
						</td>
						<td colspan="4"></td>
						<td colspan="2"></td>
						<td colspan="1"></td>
						<td colspan="1">
							@if(isset($user->educational_backgrounds[2]))
								{{$user->educational_backgrounds[2]->period_att_from}}
							@endisset
						</td>
						<td colspan="1">
							@if(isset($user->educational_backgrounds[2]))
								{{$user->educational_backgrounds[2]->period_att_to}}
							@endisset
						</td>
						<td colspan="1">
							@if(isset($user->educational_backgrounds[2]))
							{{date('Y/m/d', strtotime($user->educational_backgrounds[2]->year_graduated))}}
							@endisset
						</td>
						<td colspan="1"></td>
					</tr>
					<tr>
						<td colspan="1" class="s-label">
							<span class="count"></span> COLLEGE
						</td>
						<td colspan="4"></td>
						<td colspan="2"></td>
						<td colspan="1"></td>
						<td colspan="1">
							@if(isset($user->educational_backgrounds[3]))
								{{$user->educational_backgrounds[3]->period_att_from}}
							@endisset
						</td>
						<td colspan="1">
							@if(isset($user->educational_backgrounds[3]))
								{{$user->educational_backgrounds[3]->period_att_to}}
							@endisset
						</td>
						<td colspan="1">
							@if(isset($user->educational_backgrounds[3]))
							{{date('Y/m/d', strtotime($user->educational_backgrounds[3]->year_graduated))}}
							@endisset
						</td>
						<td colspan="1"></td>
					</tr>
					<tr>
						<td colspan="1" class="s-label">
							<span class="count"></span> GRADUATE STUDIES
						</td>
						<td colspan="4"></td>
						<td colspan="2"></td>
						<td colspan="1"></td>
						<td colspan="1">
							@if(isset($user->educational_backgrounds[4]))
								{{$user->educational_backgrounds[4]->period_att_from}}
							@endisset
						</td>
						<td colspan="1">
							@if(isset($user->educational_backgrounds[4]))
								{{$user->educational_backgrounds[4]->period_att_to}}
							@endisset
						</td>
						<td colspan="1">
							@if(isset($user->educational_backgrounds[4]))
							{{date('Y/m/d', strtotime($user->educational_backgrounds[4]->year_graduated))}}
							@endisset
						</td>
						<td colspan="1"></td>
					</tr>
				</tbody>

				<tbody class="table-body">
					<tr>
						<td colspan="12" class="text-white separator bg-transparent text-danger text-center">
							<i>(Continue on seperate sheet if necessary)</i>
						</td>
					</tr>
					<tr>
						<td colspan="1" class="text-center"><i><b>SIGNATURE</b></i></td>
						<td colspan="6"></td>
						<td colspan="2" class="text-center"><i><b>DATE</b></i></td>
						<td colspan="3"></td>
					</tr>
				</tbody>

				<!-- End of Page 1 -->

				<tbody class="table-body">
					<tr>
						<td colspan="12" class="text-white separator">IV.  CIVIL SERVICE ELIGIBILITY</td>
					</tr>
					<tr class="text-center">
						<td colspan="5" class="s-label border-bottom-0" style="width:30%">
							<span class="count float-left">27.</span>
							CAREER SERVICE/ RA 1080 (BOARD/ BAR) UNDER SPECIAL LAWS/ CES/ CSEE
							BARANGAY ELIGIBILITY / DRIVER'S LICENSE
						</td>
						<td colspan="1" class="s-label border-bottom-0">RATING<br>(If Applicable)</td>
						<td colspan="2" class="s-label border-bottom-0">DATE OF EXAMINATION / CONFERMENT</td>
						<td colspan="2" class="s-label border-bottom-0">PLACE OF EXAMINATION / CONFERMENT</td>
						<td colspan="2" class="s-label border-bottom-0">LICENSE<br>(if applicable)</td>
					</tr>
					<tr class="text-center">
						<td colspan="5" class="s-label border-top-0"></td>
						<td colspan="1" class="s-label border-top-0"></td>
						<td colspan="2" class="s-label border-top-0"></td>
						<td colspan="2" class="s-label border-top-0"></td>
						<td colspan="1" class="s-label">NUMBER</td>
						<td colspan="1" class="s-label">Date of Validity</td>
					</tr>
					<tr>
						<td colspan="5">
							@if(isset($user->eligibilities[0]))
								{{$user->eligibilities[0]->career_exam}}
							@endisset
						</td>
						<td colspan="1">
							@if(isset($user->eligibilities[0]))
								{{$user->eligibilities[0]->rating}}
							@endisset
						</td>
						<td colspan="2">
							@if(isset($user->eligibilities[0]))
								{{$user->eligibilities[0]->date_exam}}
							@endisset
						</td>
						<td colspan="2">
							@if(isset($user->eligibilities[0]))
								{{$user->eligibilities[0]->place_exam}}
							@endisset
						</td>
						<td colspan="1">
							@if(isset($user->eligibilities[0]))
								{{$user->eligibilities[0]->license_no}}
							@endisset
						</td>
						<td colspan="1">
							@if(isset($user->eligibilities[0]))
								{{$user->eligibilities[0]->license_validity}}
							@endisset
						</td>
					</tr>
					<tr>
						<td colspan="5">
							@if(isset($user->eligibilities[1]))
								{{$user->eligibilities[1]->career_exam}}
							@endisset
						</td>
						<td colspan="1">
							@if(isset($user->eligibilities[1]))
								{{$user->eligibilities[1]->rating}}
							@endisset
						</td>
						<td colspan="2">
							@if(isset($user->eligibilities[1]))
								{{$user->eligibilities[1]->date_exam}}
							@endisset
						</td>
						<td colspan="2">
							@if(isset($user->eligibilities[1]))
								{{$user->eligibilities[1]->place_exam}}
							@endisset
						</td>
						<td colspan="1">
							@if(isset($user->eligibilities[1]))
								{{$user->eligibilities[1]->license_no}}
							@endisset
						</td>
						<td colspan="1">
							@if(isset($user->eligibilities[1]))
								{{$user->eligibilities[1]->license_validity}}
							@endisset
						</td>
					</tr>
					<tr>
						<td colspan="5">
							@if(isset($user->eligibilities[2]))
								{{$user->eligibilities[2]->career_exam}}
							@endisset
						</td>
						<td colspan="1">
							@if(isset($user->eligibilities[2]))
								{{$user->eligibilities[2]->rating}}
							@endisset
						</td>
						<td colspan="2">
							@if(isset($user->eligibilities[2]))
								{{$user->eligibilities[2]->date_exam}}
							@endisset
						</td>
						<td colspan="2">
							@if(isset($user->eligibilities[2]))
								{{$user->eligibilities[2]->place_exam}}
							@endisset
						</td>
						<td colspan="1">
							@if(isset($user->eligibilities[2]))
								{{$user->eligibilities[2]->license_no}}
							@endisset
						</td>
						<td colspan="1">
							@if(isset($user->eligibilities[2]))
								{{$user->eligibilities[2]->license_validity}}
							@endisset
						</td>
					</tr>
					<tr>
						<td colspan="5">
							@if(isset($user->eligibilities[3]))
								{{$user->eligibilities[3]->career_exam}}
							@endisset
						</td>
						<td colspan="1">
							@if(isset($user->eligibilities[3]))
								{{$user->eligibilities[3]->rating}}
							@endisset
						</td>
						<td colspan="2">
							@if(isset($user->eligibilities[3]))
								{{$user->eligibilities[3]->date_exam}}
							@endisset
						</td>
						<td colspan="2">
							@if(isset($user->eligibilities[3]))
								{{$user->eligibilities[3]->place_exam}}
							@endisset
						</td>
						<td colspan="1">
							@if(isset($user->eligibilities[3]))
								{{$user->eligibilities[3]->license_no}}
							@endisset
						</td>
						<td colspan="1">
							@if(isset($user->eligibilities[3]))
								{{$user->eligibilities[3]->license_validity}}
							@endisset
						</td>
					</tr>
				</tbody>

				<tbody class="table-body">
					<tr>
						<td colspan="12" class="text-white separator bg-transparent text-danger text-center">
							<i>(Continue on seperate sheet if necessary)</i>
						</td>
					</tr>
				</tbody>

				<tbody class="table-body">
					<tr>
						<td colspan="12" class="text-white separator">
							V.  WORK EXPERIENCE<br>
							<small><i>(Include private employment.  Start from your recent work) Description of duties should be indicated in the attached Work Experience sheet.</i></small>
						</td>
					</tr>
					<tr class="text-center">
						<td colspan="1" class="s-label border-bottom-0" style="width: 20%;">
							<span class="count float-left">28.</span>
							INCLUSIVE DATES<br>(mm/dd/yyyy)
							
						</td>
						<td colspan="5" class="s-label border-bottom-0">
							POSITION TITLE<br>
							Write in full/Do not abbreviate)
						</td>
						<td colspan="2" class="s-label border-bottom-0">
							DEPARTMENT/AGENCY/OFFICE/COMPANY<br>
							(Write in full/Do not abbreviate)
						</td>
						<td colspan="1" class="s-label border-bottom-0">MONTHLY<br>SALARY</td>
						<td colspan="1" class="s-label border-bottom-0"><small>SALARY/ JOB/ PAY<br>GRADE (if applicable)& STEP  (Format "00-0")/ INCREMENT</small></td>
						<td colspan="1" class="s-label border-bottom-0">STATUS OF<br>APPOINTMENT</td>
						<td colspan="1" class="s-label border-bottom-0">GOV'T SERVICE<br>
							<small>(Y/ N)</small></td>
					</tr>
					<tr>
						<td colspan="1" class="p-0">
						<table class="w-100 border-0">
							<tbody class="border-0">
								<tr class="text-center">
									<td class="s-label border-0 border-bottom-0" style="width: 50%;">From</td>
									<td class="s-label border-top-0 border-right-0 border-bottom-0" style="width: 50%;">To</td>
								</tr>
							</tbody>
						</table>
						</td>
						<td colspan="5" class="s-label border-top-0"></td>
						<td colspan="2" class="s-label border-top-0"></td>
						<td colspan="1" class="s-label border-top-0"></td>
						<td colspan="1" class="s-label border-top-0"></td>
						<td colspan="1" class="s-label border-top-0"></td>
						<td colspan="1" class="s-label border-top-0"></td>
					</tr>
					<tr>
						<td colspan="1" class="p-0">
						<table class="w-100 border-0">
							<tbody class="border-0">
								<tr>
									<td class="border-0 border-bottom-0" style="width: 50%;">
										@if(isset($user->work_experiences[0]))
											{{ date('m/d/Y', strtotime($user->work_experiences[0]->work_ex_from)) }}
										@endisset
									</td>
									<td class="border-top-0 border-right-0 border-bottom-0" style="width: 50%;">
										@if(isset($user->work_experiences[0]))
											{{ date('m/d/Y', strtotime($user->work_experiences[0]->work_ex_to)) }}
										@endisset
									</td>
								</tr>
							</tbody>
						</table>
						</td>
						<td colspan="5">
							@if(isset($user->work_experiences[0]))
								{{ $user->work_experiences[0]->position_title }}
							@endisset
						</td>
						<td colspan="2">
							@if(isset($user->work_experiences[0]))
								{{ $user->work_experiences[0]->department_agency }}
							@endisset
						</td>
						<td colspan="1">
							@if(isset($user->work_experiences[0]))
								{{ $user->work_experiences[0]->salary }}
							@endisset
						</td>
						<td colspan="1">
							@if(isset($user->work_experiences[0]))
								{{ $user->work_experiences[0]->pay_grade }}
							@endisset
						</td>
						<td colspan="1">@if(isset($user->work_experiences[0]))
							{{ $user->work_experiences[0]->status_appointment }}
						@endisset</td>
						<td colspan="1">
							@if(isset($user->work_experiences[0]))
								@if ($user->work_experiences[0]->is_govt)
									YES
								@else
									NO
								@endif
							@endisset
						</td>
					</tr>
					<tr>
						<td colspan="1" class="p-0">
						<table class="w-100 border-0">
							<tbody class="border-0">
								<tr>
									<td class="border-0 border-bottom-0" style="width: 50%;">
										@if(isset($user->work_experiences[1]))
											{{ date('m/d/Y', strtotime($user->work_experiences[1]->work_ex_from)) }}
										@endisset
									</td>
									<td class="border-top-0 border-right-0 border-bottom-0" style="width: 50%;">
										@if(isset($user->work_experiences[1]))
											{{ date('m/d/Y', strtotime($user->work_experiences[1]->work_ex_to)) }}
										@endisset
									</td>
								</tr>
							</tbody>
						</table>
						</td>
						<td colspan="5">
							@if(isset($user->work_experiences[1]))
								{{ $user->work_experiences[1]->position_title }}
							@endisset
						</td>
						<td colspan="2">
							@if(isset($user->work_experiences[1]))
								{{ $user->work_experiences[1]->department_agency }}
							@endisset
						</td>
						<td colspan="1">
							@if(isset($user->work_experiences[1]))
								{{ $user->work_experiences[1]->salary }}
							@endisset
						</td>
						<td colspan="1">
							@if(isset($user->work_experiences[1]))
								{{ $user->work_experiences[1]->pay_grade }}
							@endisset
						</td>
						<td colspan="1">@if(isset($user->work_experiences[1]))
							{{ $user->work_experiences[1]->status_appointment }}
						@endisset</td>
						<td colspan="1">
							@if(isset($user->work_experiences[1]))
								@if ($user->work_experiences[1]->is_govt)
									YES
								@else
									NO
								@endif
							@endisset
						</td>
					</tr>
					<tr>
						<td colspan="1" class="p-0">
						<table class="w-100 border-0">
							<tbody class="border-0">
								<tr>
									<td class="border-0 border-bottom-0" style="width: 50%;">
										@if(isset($user->work_experiences[2]))
											{{ date('m/d/Y', strtotime($user->work_experiences[2]->work_ex_from)) }}
										@endisset
									</td>
									<td class="border-top-0 border-right-0 border-bottom-0" style="width: 50%;">
										@if(isset($user->work_experiences[2]))
											{{ date('m/d/Y', strtotime($user->work_experiences[2]->work_ex_to)) }}
										@endisset
									</td>
								</tr>
							</tbody>
						</table>
						</td>
						<td colspan="5">
							@if(isset($user->work_experiences[2]))
								{{ $user->work_experiences[2]->position_title }}
							@endisset
						</td>
						<td colspan="2">
							@if(isset($user->work_experiences[2]))
								{{ $user->work_experiences[2]->department_agency }}
							@endisset
						</td>
						<td colspan="1">
							@if(isset($user->work_experiences[2]))
								{{ $user->work_experiences[2]->salary }}
							@endisset
						</td>
						<td colspan="1">
							@if(isset($user->work_experiences[2]))
								{{ $user->work_experiences[2]->pay_grade }}
							@endisset
						</td>
						<td colspan="1">@if(isset($user->work_experiences[2]))
							{{ $user->work_experiences[2]->status_appointment }}
						@endisset</td>
						<td colspan="1">
							@if(isset($user->work_experiences[2]))
								@if ($user->work_experiences[2]->is_govt)
									YES
								@else
									NO
								@endif
							@endisset
						</td>
					</tr>
					<tr>
						<td colspan="1" class="p-0">
						<table class="w-100 border-0">
							<tbody class="border-0">
								<tr>
									<td class="border-0 border-bottom-0" style="width: 50%;">
										@if(isset($user->work_experiences[3]))
											{{ date('m/d/Y', strtotime($user->work_experiences[3]->work_ex_from)) }}
										@endisset
									</td>
									<td class="border-top-0 border-right-0 border-bottom-0" style="width: 50%;">
										@if(isset($user->work_experiences[3]))
											{{ date('m/d/Y', strtotime($user->work_experiences[3]->work_ex_to)) }}
										@endisset
									</td>
								</tr>
							</tbody>
						</table>
						</td>
						<td colspan="5">
							@if(isset($user->work_experiences[3]))
								{{ $user->work_experiences[3]->position_title }}
							@endisset
						</td>
						<td colspan="3">
							@if(isset($user->work_experiences[3]))
								{{ $user->work_experiences[3]->department_agency }}
							@endisset
						</td>
						<td colspan="1">
							@if(isset($user->work_experiences[3]))
								{{ $user->work_experiences[3]->salary }}
							@endisset
						</td>
						<td colspan="1">
							@if(isset($user->work_experiences[3]))
								{{ $user->work_experiences[3]->pay_grade }}
							@endisset
						</td>
						<td colspan="1">@if(isset($user->work_experiences[3]))
							{{ $user->work_experiences[3]->status_appointment }}
						@endisset</td>
						<td colspan="1">
							@if(isset($user->work_experiences[3]))
								@if ($user->work_experiences[3]->is_govt)
									YES
								@else
									NO
								@endif
							@endisset
						</td>
					</tr>
				</tbody>

				<tbody class="table-body">
					<tr>
						<td colspan="12" class="text-white separator bg-transparent text-danger text-center">
							<i>(Continue on seperate sheet if necessary)</i>
						</td>
					</tr>
					<tr>
						<td colspan="1" class="text-center"><i><b>SIGNATURE</b></i></td>
						<td colspan="6"></td>
						<td colspan="2" class="text-center"><i><b>DATE</b></i></td>
						<td colspan="3"></td>
					</tr>
				</tbody>

				<!-- End of Page 2 -->

				<tbody class="table-body">
					<tr>
						<td colspan="12" class="text-white separator">VI. VOLUNTARY WORK OR INVOLVEMENT IN CIVIC / NON-GOVERNMENT / PEOPLE / VOLUNTARY ORGANIZATION/S</td>
					</tr>
					<tr class="text-center">
						<td colspan="6" class="s-label border-bottom-0">
							<span class="count float-left">29.</span> NAME & ADDRESS OF ORGANIZATION<br>
							(Write in full)
						</td>
						<td colspan="2" class="s-label border-bottom-0">INCLUSIVE DATES</td>
						<td colspan="1" class="s-label border-bottom-0">NUMBER OF HOURS</td>
						<td colspan="3" class="s-label border-bottom-0">POSITION / NATURE OF WORK</td>
					</tr>
					<tr class="text-center">
						<td colspan="6" class="s-label border-top-0"></td>
						<td colspan="1" class="s-label">From</td>
						<td colspan="1" class="s-label">To</td>
						<td colspan="1" class="s-label border-top-0"></td>
						<td colspan="3" class="s-label border-top-0"></td>
					</tr>
					<tr>
						<td colspan="6">
							@if(isset($user->voluntary_works[0]))
								{{ $user->voluntary_works[0]->name_address_org }}
							@endisset
						</td>
						<td colspan="1">
							@if(isset($user->voluntary_works[0]))
								{{ $user->voluntary_works[0]->work_from }}
							@endisset
						</td>
						<td colspan="1">
							@if(isset($user->voluntary_works[0]))
								{{ $user->voluntary_works[0]->work_to }}
							@endisset
						</td>
						<td colspan="1">
							@if(isset($user->voluntary_works[0]))
								{{ $user->voluntary_works[0]->no_hours }}
							@endisset
						</td>
						<td colspan="3">
							@if(isset($user->voluntary_works[0]))
								{{ $user->voluntary_works[0]->nature_work }}
							@endisset
						</td>
					</tr>
					<tr>
						<td colspan="6">
							@if(isset($user->voluntary_works[1]))
								{{ $user->voluntary_works[1]->name_address_org }}
							@endisset
						</td>
						<td colspan="1">
							@if(isset($user->voluntary_works[1]))
								{{ $user->voluntary_works[1]->work_from }}
							@endisset
						</td>
						<td colspan="1">
							@if(isset($user->voluntary_works[1]))
								{{ $user->voluntary_works[1]->work_to }}
							@endisset
						</td>
						<td colspan="1">
							@if(isset($user->voluntary_works[1]))
								{{ $user->voluntary_works[1]->no_hours }}
							@endisset
						</td>
						<td colspan="3">
							@if(isset($user->voluntary_works[1]))
								{{ $user->voluntary_works[1]->nature_work }}
							@endisset
						</td>
					</tr>
					<tr>
						<td colspan="6">
							@if(isset($user->voluntary_works[2]))
								{{ $user->voluntary_works[2]->name_address_org }}
							@endisset
						</td>
						<td colspan="1">
							@if(isset($user->voluntary_works[2]))
								{{ $user->voluntary_works[2]->work_from }}
							@endisset
						</td>
						<td colspan="1">
							@if(isset($user->voluntary_works[2]))
								{{ $user->voluntary_works[2]->work_to }}
							@endisset
						</td>
						<td colspan="1">
							@if(isset($user->voluntary_works[2]))
								{{ $user->voluntary_works[2]->no_hours }}
							@endisset
						</td>
						<td colspan="3">
							@if(isset($user->voluntary_works[2]))
								{{ $user->voluntary_works[2]->nature_work }}
							@endisset
						</td>
					</tr>
					<tr>
						<td colspan="6">
							@if(isset($user->voluntary_works[3]))
								{{ $user->voluntary_works[3]->name_address_org }}
							@endisset
						</td>
						<td colspan="1">
							@if(isset($user->voluntary_works[3]))
								{{ $user->voluntary_works[3]->work_from }}
							@endisset
						</td>
						<td colspan="1">
							@if(isset($user->voluntary_works[3]))
								{{ $user->voluntary_works[3]->work_to }}
							@endisset
						</td>
						<td colspan="1">
							@if(isset($user->voluntary_works[3]))
								{{ $user->voluntary_works[3]->no_hours }}
							@endisset
						</td>
						<td colspan="3">
							@if(isset($user->voluntary_works[3]))
								{{ $user->voluntary_works[3]->nature_work }}
							@endisset
						</td>
					</tr>
				</tbody>

				<tbody class="table-body">
					<tr>
						<td colspan="12" class="text-white separator bg-transparent text-danger text-center">
							<i>(Continue on seperate sheet if necessary)</i>
						</td>
					</tr>
				</tbody>

				<tbody class="table-body">
					<tr>
						<td colspan="12" class="text-white separator">VI. VOLUNTARY WORK OR INVOLVEMENT IN CIVIC / NON-GOVERNMENT / PEOPLE / VOLUNTARY ORGANIZATION/S<br>
							<small><i>(Start from the most recent L&D/training program and include only the relevant L&D/training taken for the last five (5) years for Division Chief/Executive/Managerial positions)</i></small>
						</td>
					</tr>
					<tr class="text-center">
						<td colspan="6" class="s-label border-bottom-0">
							<span class="count float-left">30.</span> TITLE OF LEARNING AND DEVELOPMENT INTERVENTIONS/TRAINING PROGRAMS<br>
							(Write in full)
						</td>
						<td colspan="2" class="s-label border-bottom-0">INCLUSIVE DATES</td>
						<td colspan="1" class="s-label border-bottom-0">NUMBER OF HOURS</td>
						<td colspan="1" class="s-label border-bottom-0">Type of LD ( Managerial/ Supervisory/Technical/etc)</td>
						<td colspan="2" class="s-label border-bottom-0">CONDUCTED/ SPONSORED BY<br>(Write in full)</td>
					</tr>
					<tr class="text-center">
						<td colspan="6" class="s-label border-top-0"></td>
						<td colspan="1" class="s-label">From</td>
						<td colspan="1" class="s-label">To</td>
						<td colspan="1" class="s-label border-top-0"></td>
						<td colspan="1" class="s-label border-top-0"></td>
						<td colspan="2" class="s-label border-top-0"></td>
					</tr>
					<tr>
						<td colspan="6">
							@if(isset($user->learning_developments[0]))
								{{ $user->learning_developments[0]->title_learning_dev }}
							@endisset
						</td>
						<td colspan="1">
							@if(isset($user->learning_developments[0]))
								{{ $user->learning_developments[0]->date_from }}
							@endisset
						</td>
						<td colspan="1">
							@if(isset($user->learning_developments[0]))
								{{ $user->learning_developments[0]->date_to }}
							@endisset
						</td>
						<td colspan="1">
							@if(isset($user->learning_developments[0]))
								{{ $user->learning_developments[0]->no_hours }}
							@endisset
						</td>
						<td colspan="1">
							@if(isset($user->learning_developments[0]))
								{{ $user->learning_developments[0]->type_ld }}
							@endisset
						</td>
						<td colspan="2">
							@if(isset($user->learning_developments[0]))
								{{ $user->learning_developments[0]->sponsored_by }}
							@endisset
						</td>
					</tr>
					<tr>
						<td colspan="6">
							@if(isset($user->learning_developments[1]))
								{{ $user->learning_developments[1]->title_learning_dev }}
							@endisset
						</td>
						<td colspan="1">
							@if(isset($user->learning_developments[1]))
								{{ $user->learning_developments[1]->date_from }}
							@endisset
						</td>
						<td colspan="1">
							@if(isset($user->learning_developments[1]))
								{{ $user->learning_developments[1]->date_to }}
							@endisset
						</td>
						<td colspan="1">
							@if(isset($user->learning_developments[1]))
								{{ $user->learning_developments[1]->no_hours }}
							@endisset
						</td>
						<td colspan="1">
							@if(isset($user->learning_developments[1]))
								{{ $user->learning_developments[1]->type_ld }}
							@endisset
						</td>
						<td colspan="2">
							@if(isset($user->learning_developments[1]))
								{{ $user->learning_developments[1]->sponsored_by }}
							@endisset
						</td>
					</tr>
					<tr>
						<td colspan="6">
							@if(isset($user->learning_developments[2]))
								{{ $user->learning_developments[2]->title_learning_dev }}
							@endisset
						</td>
						<td colspan="1">
							@if(isset($user->learning_developments[2]))
								{{ $user->learning_developments[2]->date_from }}
							@endisset
						</td>
						<td colspan="1">
							@if(isset($user->learning_developments[2]))
								{{ $user->learning_developments[2]->date_to }}
							@endisset
						</td>
						<td colspan="1">
							@if(isset($user->learning_developments[2]))
								{{ $user->learning_developments[2]->no_hours }}
							@endisset
						</td>
						<td colspan="1">
							@if(isset($user->learning_developments[2]))
								{{ $user->learning_developments[2]->type_ld }}
							@endisset
						</td>
						<td colspan="2">
							@if(isset($user->learning_developments[2]))
								{{ $user->learning_developments[2]->sponsored_by }}
							@endisset
						</td>
					</tr>
					<tr>
						<td colspan="6">
							@if(isset($user->learning_developments[3]))
								{{ $user->learning_developments[3]->title_learning_dev }}
							@endisset
						</td>
						<td colspan="1">
							@if(isset($user->learning_developments[3]))
								{{ $user->learning_developments[3]->date_from }}
							@endisset
						</td>
						<td colspan="1">
							@if(isset($user->learning_developments[3]))
								{{ $user->learning_developments[3]->date_to }}
							@endisset
						</td>
						<td colspan="1">
							@if(isset($user->learning_developments[3]))
								{{ $user->learning_developments[3]->no_hours }}
							@endisset
						</td>
						<td colspan="1">
							@if(isset($user->learning_developments[3]))
								{{ $user->learning_developments[3]->type_ld }}
							@endisset
						</td>
						<td colspan="2">
							@if(isset($user->learning_developments[3]))
								{{ $user->learning_developments[3]->sponsored_by }}
							@endisset
						</td>
					</tr>
					<tr>
						<td colspan="6">
							@if(isset($user->learning_developments[4]))
								{{ $user->learning_developments[4]->title_learning_dev }}
							@endisset
						</td>
						<td colspan="1">
							@if(isset($user->learning_developments[4]))
								{{ $user->learning_developments[4]->date_from }}
							@endisset
						</td>
						<td colspan="1">
							@if(isset($user->learning_developments[4]))
								{{ $user->learning_developments[4]->date_to }}
							@endisset
						</td>
						<td colspan="1">
							@if(isset($user->learning_developments[4]))
								{{ $user->learning_developments[4]->no_hours }}
							@endisset
						</td>
						<td colspan="1">
							@if(isset($user->learning_developments[4]))
								{{ $user->learning_developments[4]->type_ld }}
							@endisset
						</td>
						<td colspan="2">
							@if(isset($user->learning_developments[4]))
								{{ $user->learning_developments[4]->sponsored_by }}
							@endisset
						</td>
					</tr>
				</tbody>

				<tbody class="table-body">
					<tr>
						<td colspan="12" class="text-white separator bg-transparent text-danger text-center">
							<i>(Continue on seperate sheet if necessary)</i>
						</td>
					</tr>
				</tbody>
				
				<tbody class="table-body">
					<tr>
						<td colspan="12" class="text-white separator">VIII.  OTHER INFORMATION</td>
					</tr>
					<tr class="text-center">
						<td colspan="4" class="s-label">
							<span class="count float-left">31.</span> SPECIAL SKILLS and HOBBIES
						</td>
						<td colspan="4" class="s-label">
							<span class="count float-left">32.</span> NON-ACADEMIC DISTINCTIONS / RECOGNITION<br>(Write in full)
						</td>
						<td colspan="4" class="s-label">
							<span class="count float-left">33.</span> MEMBERSHIP IN ASSOCIATION/ORGANIZATION<br>(Write in full)
						</td>
					</tr>
					<tr>
						<td colspan="4">
							@if(isset($user->other_informations[0]))
								{{ $user->other_informations[0]->non_academic_distinction }}
							@endisset
						</td>
						<td colspan="4">
							@if(isset($user->other_informations[0]))
								{{ $user->other_informations[0]->member_association }}
							@endisset
						</td>
						<td colspan="4">
							@if(isset($user->other_informations[0]))
								{{ $user->other_informations[0]->skill_hobbies }}
							@endisset
						</td>
					</tr>
					<tr>
						<td colspan="4">
							@if(isset($user->other_informations[1]))
								{{ $user->other_informations[1]->non_academic_distinction }}
							@endisset
						</td>
						<td colspan="4">
							@if(isset($user->other_informations[1]))
								{{ $user->other_informations[1]->member_association }}
							@endisset
						</td>
						<td colspan="4">
							@if(isset($user->other_informations[1]))
								{{ $user->other_informations[1]->skill_hobbies }}
							@endisset
						</td>
					</tr>
					<tr>
						<td colspan="4">
							@if(isset($user->other_informations[2]))
								{{ $user->other_informations[2]->non_academic_distinction }}
							@endisset
						</td>
						<td colspan="4">
							@if(isset($user->other_informations[2]))
								{{ $user->other_informations[2]->member_association }}
							@endisset
						</td>
						<td colspan="4">
							@if(isset($user->other_informations[2]))
								{{ $user->other_informations[2]->skill_hobbies }}
							@endisset
						</td>
					</tr>
					<tr>
						<td colspan="4">
							@if(isset($user->other_informations[3]))
								{{ $user->other_informations[3]->non_academic_distinction }}
							@endisset
						</td>
						<td colspan="4">
							@if(isset($user->other_informations[3]))
								{{ $user->other_informations[3]->member_association }}
							@endisset
						</td>
						<td colspan="4">
							@if(isset($user->other_informations[3]))
								{{ $user->other_informations[3]->skill_hobbies }}
							@endisset
						</td>
					</tr>
				</tbody>

				<tbody class="table-body">
					<tr>
						<td colspan="12" class="text-white separator bg-transparent text-danger text-center">
							<i>(Continue on seperate sheet if necessary)</i>
						</td>
					</tr>
					<tr>
						<td colspan="4" class="text-center"><i><b>SIGNATURE</b></i></td>
						<td colspan="3"></td>
						<td colspan="1" class="text-center"><i><b>DATE</b></i></td>
						<td colspan="4"></td>
					</tr>
				</tbody>

				<!-- End of Page 3 -->

				<!-- Q1 -->
				<tbody class="table-body question-block">
					<tr>
						<td colspan="12" class="separator"></td>
					</tr>
					<tr>
						<td colspan="7" class="s-label border-bottom-0">
							<span class="count">34.</span> Are you related by consanguinity or affinity to the appointing or recommending authority, or to the<br>
							<span class="count"></span>chief of bureau or office or to the person who has immediate supervision over you in the Office,<br>
							<span class="count"></span>Bureau or Department where you will beapppointed,<br>
						</td>
						<td colspan="2">
							
						</td>
						<td colspan="3">
							
						</td>
					</tr>
					<tr>
						<td colspan="7" class="s-label">
							<span class="count"></span>a. within the third degree?<br>
						</td>
						<td colspan="2">
							@if ($user->related_with_third_degree)
								YES
							@else
								NO
							@endif
						</td>
						<td colspan="3"></td>
					</tr>
					<tr>
						<td colspan="7" class="s-label">
							<span class="count"></span>b. within the fourth degree (for Local Government Unit - Career Employees)?
						</td>
						<td colspan="2">
							@if ($user->related_with_fourth_degree)
								YES
							@else
								NO
							@endif
						</td>
						<td colspan="3"></td>
					</tr>
					<tr>
						<td colspan="7" class="s-label">
						</td>
						<td colspan="2">If YES, give details:</td>
						<td colspan="3">
							{{$user->related_with_fourth_degree_yes}}
						</td>
					</tr>
					<tr>
						<td colspan="7" class="s-label"></td>
						<td colspan="5"></td>
					</tr>
				</tbody>

				<!-- Q2 -->
				<tbody class="table-body question-block">
					<tr>
						<td colspan="7" class="s-label border-bottom-0">
							<span class="count">35.</span> a. Have you ever been found guilty of any administrative offense?
						</td>
						<td colspan="2">
							@if ($user->is_guilty_administrative_offense)
								YES
							@else
								NO
							@endif
						</td>
						<td colspan="3"></td>
					</tr>
					<tr>
						<td colspan="7" class="s-label"></td>
						<td colspan="5">If YES, give details:</td>
					</tr>
					<tr>
						<td colspan="7" class="s-label"></td>
						<td colspan="5">{{$user->is_guilty_administrative_offense_yes}}</td>
					</tr>
					<tr>
						<td colspan="7" class="s-label">
							<span class="count"></span> b. Have you been criminally charged before any court?
						</td>
						<td colspan="2" style="border-top-width: 1px !important;">
							@if ($user->is_criminally_charge)
								YES
							@else
								NO
							@endif
						</td>
						<td colspan="3" style="border-top-width: 1px !important;"></td>
					</tr>
					<tr>
						<td colspan="7" class="s-label"></td>
						<td colspan="5">If YES, give details: &nbsp; {{$user->is_criminally_charge_yes}}</td>
					</tr>
					<tr>
						<td colspan="7" class="s-label"></td>
						<td colspan="2">Date Filed: {{$user->date_filed}}</td>
						<td colspan="3"></td>
					</tr>
					<tr>
						<td colspan="7" class="s-label"></td>
						<td colspan="2">Status of Case/s: &nbsp; {{$user->case_status}}</td>
						<td colspan="3"></td>
					</tr>
				</tbody>

				<!-- Q3 -->
				<tbody class="table-body question-block">
					<tr>
						<td colspan="7" class="s-label border-bottom-0">
							<span class="count">36.</span> Have you ever been convicted of any crime or violation of any law, decree, ordinance or regulation by any court or tribunal?
						</td>
						<td colspan="2">
							@if ($user->is_convicted)
								YES
							@else
								NO
							@endif
						</td>
						<td colspan="3"></td>
					</tr>
					<tr>
						<td colspan="7" class="s-label"></td>
						<td colspan="5">If YES, give details: &nbsp; {{$user->is_convicted_yes}}</td>
					</tr>
					<tr>
						<td colspan="7" class="s-label"></td>
						<td colspan="5"></td>
					</tr>
				</tbody>

				<!-- Q4 -->
				<tbody class="table-body question-block">
					<tr>
						<td colspan="7" class="s-label border-bottom-0">
							<span class="count">37.</span> Have you ever been separated from the service in any of the following modes: resignation,<br>
							
							
						</td>
						<td colspan="2">
							@if ($user->is_separated)
								YES
							@else
								NO
							@endif
						</td>
						<td colspan="3"></td>
					</tr>
					<tr>
						<td colspan="7" class="s-label">
							<span class="count"></span> retirement, dropped from the rolls, dismissal, termination, end of term, finished contract or phased<br>
						</td>
						<td colspan="5">If YES, give details: &nbsp; {{$user->is_separated_yes_details}}</td>
					</tr>
					<tr>
						<td colspan="7" class="s-label">
							<span class="count"></span> out (abolition) in the public or private sector?
						</td>
						<td colspan="2"></td>
						<td colspan="3"></td>
					</tr>
				</tbody>

				<!-- Q5 -->
				<tbody class="table-body question-block">
					<tr>
						<td colspan="7" class="s-label border-bottom-0">
							<span class="count">38.</span> a. Have you ever been a candidate in a national or local election held within the last year (except Barangay election)?
						</td>
						<td colspan="2">
							@if ($user->is_candidate_election)
								YES
							@else
								NO
							@endif
						</td>
						<td colspan="3"></td>
					</tr>
					<tr>
						<td colspan="7" class="s-label">
							<span class="count"></span><br>
						</td>
						<td colspan="2">If YES, give details: {{$user->is_candiadte_election_yes}}</td>
						<td colspan="3"></td>
					</tr>
					<tr>
						<td colspan="7" class="s-label">
							<span class="count"></span> b. Have you resigned from the government service during the three (3)-month period before the last
						</td>
						<td colspan="2">
							@if ($user->is_resigned)
								YES
							@else
								NO
							@endif
						</td>
						<td colspan="3"></td>
					</tr>
					<tr>
						<td colspan="7" class="s-label">
							<span class="count"></span> election to promote/actively campaign for a national or local candidate?
						</td>
						<td colspan="2">If YES, give details: &nbsp; {{$user->is_resigned_yes}}</td>
						<td colspan="3"></td>
					</tr>
					<tr>
						<td colspan="7" class="s-label"></td>
						<td colspan="2"></td>
						<td colspan="3"></td>
					</tr>
				</tbody>

				<!-- Q6 -->
				<tbody class="table-body question-block">
					<tr>
						<td colspan="7" class="s-label border-bottom-0">
							<span class="count">39.</span> Have you acquired the status of an immigrant or permanent resident of another country?
						</td>
						<td colspan="2">
							@if ($user->is_immigrant)
								YES
							@else
								NO
							@endif
						</td>
						<td colspan="3"></td>
					</tr>
					<tr>
						<td colspan="7" class="s-label">
						</td>
						<td colspan="2">if YES, give details (country): &nbsp; {{$user->is_immigrant_yes}}</td>
						<td colspan="3"></td>
					</tr>
					<tr>
						<td colspan="7" class="s-label">
						</td>
						<td colspan="2"></td>
						<td colspan="3"></td>
					</tr>
				</tbody>

				<!-- Q7 -->
				<tbody class="table-body question-block">
					<tr>
						<td colspan="7" class="s-label border-bottom-0">
							<span class="count">40.</span> Pursuant to: (a) Indigenous People's Act (RA 8371); (b) Magna Carta for Disabled Persons (RA<br>
							<span class="count"></span> 7277); and (c) Solo Parents Welfare Act of 2000 (RA 8972), please answer the following items:
						</td>
						<td colspan="2">
							
						</td>
						<td colspan="3"></td>
					</tr>
					<tr>
						<td colspan="7" class="s-label">
							<span class="count"></span>a. Are you a member of any indigenous group?<br>
						</td>
						<td colspan="2">
							@if ($user->is_indigenous)
								YES
							@else
								NO
							@endif
						</td>
						<td colspan="3"></td>
					</tr>
					<tr>
						<td colspan="7" class="s-label">
							<span class="count"></span><br>
						</td>
						<td colspan="2">If YES, please specify: &nbsp; {{$user->is_indigenous_yes}}</td>
						<td colspan="3"></td>
					</tr>
					<tr>
						<td colspan="7" class="s-label">
							<span class="count"></span>b. Are you a person with disability?
						</td>
						<td colspan="2">
							@if ($user->is_disable)
								YES
							@else
								NO
							@endif
						</td>
						<td colspan="3"></td>
					</tr>
					<tr>
						<td colspan="7" class="s-label">
						</td>
						<td colspan="2">If YES, please specify: &nbsp; {{$user->is_disable_id_no}}</td>
						<td colspan="3"></td>
					</tr>
					<tr>
						<td colspan="7" class="s-label">
							<span class="count"></span>c. Are you a solo parent?
						</td>
						<td colspan="2">
							@if ($user->is_solo_parent)
								YES
							@else
								NO
							@endif
						</td>
						<td colspan="3"></td>
					</tr>
					<tr>
						<td colspan="7" class="s-label"></td>
						<td colspan="2">If YES, please specify: &nbsp; {{$user->is_solo_parent_yes}}</td>
						<td colspan="3"></td>
					</tr>
				</tbody>

				<!-- End of Page 4 -->

				<tbody class="table-body">
					<tr>
						<td colspan="8" class="s-label">
							<span class="count">41.</span> REFERENCES <span class="text-danger">(Person not related by consanguinity or affinity to applicant /appointee)</span>
						</td>
						<td colspan="4" rowspan="5" class="p-5">
							<table class="w-75 mx-auto border-0">
								<tbody class="border-0">
									<tr>
										<td class="text-center p-3">ID picture taken within the last  6 months3.5 cm. X 4.5 cm(passport size)With full and handwrittenname tag and signature overprinted nameComputer generated or photocopied picture is not acceptable</td>
									</tr>
									<tr>
										<td class="border-0 text-muted lead text-center">PHOTO</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
					<tr class="text-center">
						<td colspan="4" class="s-label">NAME</td>
						<td colspan="2" class="s-label">ADDRESS</td>
						<td colspan="2" class="s-label">TEL. NO.</td>
					</tr>
					<tr>
						<td colspan="4"></td>
						<td colspan="2"></td>
						<td colspan="2"></td>
					</tr>
					<tr>
						<td colspan="4"></td>
						<td colspan="2"></td>
						<td colspan="2"></td>
					</tr>
					<tr>
						<td colspan="8">
							<span class="count">42.</span> I declare under oath that I have personally accomplished this Personal Data Sheet which is a true correct and<br><span class="count"></span> complete statement pursuant to the provisions of pertinent laws, rules and regulations of the Republic of the<br><span class="count"></span> Philippines. I authorize the agency head / authorized representative t verify validate the contents stated herein.<br><span class="count"></span> I agree that any misrepresentation made in this document and its attachments shall cause the filing of<br><span class="count"></span> administrative/criminal case/s against me.
						</td>
					</tr>
					<tr>
						<td colspan="12" class="border-0 p-0">
							<table class="border-0 w-100">
								<tbody class="border-0">
									<tr>
										<td colspan="4" class="border-0 p-3" style="width: 38.5%;">
											<table class="border-0 w-100">
												<tbody>
													<tr>
														<td class="s-label py-2">Government Issued ID(i.e.Passport, GSIS, SSS, PRC, Driver's License, etc.)<br>                               PLEASE INDICATE ID Number and Date of Issuance</td>
													</tr>
													<tr>
														<td style="width: 30%;">Government Issued ID:</td>
													</tr>
													<tr>
														<td style="width: 30%;">ID/License/Passport No.:</td>
													</tr>
													<tr>
														<td style="width: 30%;">Date/Place of Issuance:</td>
													</tr>
												</tbody>
											</table>
										</td>
										<td colspan="4" class="border-0 p-3" style="width: 38.5%;">
											<table class="border-0 w-100">
												<tbody class="border-0 text-center">
													<tr>
														<td class="py-4"></td>
													</tr>
													<tr>
														<td class="s-label"><small>Signature (Sign inside the box)</small></td>
													</tr>
													<tr>
														<td></td>
													</tr>
													<tr>
														<td class="s-label"><small>Date Accomplished</small></td>
													</tr>
												</tbody>
											</table>
										</td>
										<td colspan="4" class="border-0 p-3">
											<table class="border-0 w-100">
												<tbody class="border-0">
													<tr>
														<td class="py-5"></td>
													</tr>
													<tr>
														<td class="s-label text-center">Right Thumbmark</td>
													</tr>
												</tbody>
											</table>
										</td>
									</tr>
								</tbody>

								<tbody class="table-body">
									<tr>
										<td colspan="12" class="text-center py-2">
											SUBSCRIBED AND SWORN to before me this <input type="text" class="border-top-0 border-left-0 border-right-0" style="width: 25%;"> , affiant exhibiting his/her validly issued government ID as indicated above.
										</td>
									</tr>
									<tr>
										<td colspan="12" class="py-5">
											<table class="w-25 mx-auto">
												<tbody>
													<tr>
														<td class="py-5"></td>
													</tr>
													<tr>
														<td class="s-label text-center">Person Administering Oath</td>
													</tr>
												</tbody>
											</table>
										</td>
									</tr>
								</tbody>

							</table>
						</td>
					</tr>
				</tbody>

				<!-- End of References -->



			</table>
		</form>
	</div>
</body>
</html>