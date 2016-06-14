{{-- table start --}}
	
	<div class="child5">
		<table class="tableDesign">
			<tr>
				<td  colspan="2"> Full Name </td>
				<td>
					{{ $child5['full_name']}} 
				</td>
			</tr>

			<tr>
				<td colspan="2">Referrar ID: </td>
				<td > {{ ReferralTableValues::referrarId($child5['referrar_id'])}} </td>
			</tr>
			<tr>
				<td colspan="2"> Upline ID: </td>
				<td > {{ ReferralTableValues::uplineId($child5['upline_id'])  }} </td>
			</tr>
			<tr>
				<td></td>
				<td>Left Position</td>
				<td>Right Position</td>
			</tr>

			{{-- <tr>
				<td> Members: </td>
				<td> {{ ReferralTableValues::leftMember($child5['id']) }} </td>
				<td> {{ ReferralTableValues::rightMember($child5['id']) }} </td>
			</tr> --}}
			<tr>
				<td>Carry: </td>
				<td> {{ ReferralTableValues::getCarryLeft( $child5['id'] ) }} </td>
				<td> {{ ReferralTableValues::getCarryRight( $child5['id'] ) }}</td>
			</tr>
			<tr>
				<td colspan="3">Joining Date : &nbsp; {{ date('Y-m-d', strtotime($child5['signup_date']))}} </td>
				<td></td>
			</tr>
		</table>
	</div>
{{-- table end --}}