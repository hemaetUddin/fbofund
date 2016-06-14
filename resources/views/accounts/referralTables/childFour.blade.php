{{-- table start --}}
	
	<div class="child4">
		<table class="tableDesign">
			<tr>
				<td> Full Name </td>
				<td colspan="2">
					{{ $child4['full_name']}} 
				</td>
			</tr>

			<tr>
				<td colspan="2">Referrar ID: </td>
				<td> {{ ReferralTableValues::referrarId( $child4['referrar_id'] )}} </td>
			</tr>
			<tr>
				<td colspan="2"> Upline ID: </td>
				<td> {{ ReferralTableValues::uplineId( $child4['upline_id'] )}} </td>
			</tr>
			<tr>
				<td></td>
				<td>Left Position</td>
				<td>Right Position</td>
			</tr>

			{{-- <tr>
				<td> Members: </td>
				<td> Tot Left </td>
				<td> Tot Right </td>
			</tr> --}}
			<tr>
				<td>Carry: </td>
				<td> {{ ReferralTableValues::getCarryLeft( $child4['id'] ) }} </td>
				<td> {{ ReferralTableValues::getCarryRight( $child4['id'] ) }}</td>
			</tr>
			<tr>
				<td colspan="3">Joining Date: &nbsp; {{ date('Y-m-d', strtotime( $child4['signup_date'] ))}} </td>
				<td></td>
			</tr>
		</table>
	</div>
{{-- table end --}}