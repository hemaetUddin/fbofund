{{-- table start --}}
	
	<div class="info-table1">
		<table class="tableDesign">
			<tr>
				<td> Full Name </td>
				<td colspan="2">
					{{ $topUserInfo['full_name']}} 
				</td>
			</tr>

			<tr>
				<td colspan="2">Referrar ID: </td>
				<td> {{ ReferralTableValues::referrarId($topUserInfo['referrar_id'])}} </td>
			</tr>
			<tr>
				<td colspan="2"> Upline ID: </td>
				<td> {{ ReferralTableValues::uplineId($topUserInfo['upline_id']) }} </td>
			</tr>
			<tr>
				<td></td>
				<td>Left Position</td>
				<td>Right Position</td>
			</tr>

			<tr>
				<td> Members: </td>
				<td> {!! ReferralTableValues::leftMem($topUserInfo['id']) !!} </td>
				<td> {!! ReferralTableValues::rightMem($topUserInfo['id']) !!} </td>
			</tr>
			<tr>
				<td>Carry: </td>
				<td> {{ ReferralTableValues::getCarryLeft( $topUserInfo['id'] ) }} </td>
				<td> {{ ReferralTableValues::getCarryRight( $topUserInfo['id'] ) }}</td>
			</tr>
			<tr>
				<td colspan="3">Joining Date: &nbsp; {{ date('Y-m-d', strtotime( $topUserInfo['signup_date'] ))}}</td>
				<td></td>
			</tr>
		</table>
	</div>
{{-- table end --}}