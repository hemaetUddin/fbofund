{{-- table start --}}
	
	<div class="child6">
		<table class="tableDesign">
			<tr>
				<td> Full Name </td>
				<td colspan="2">
					{{ $child6['full_name']}} 
				</td>
			</tr>

			<tr>
				<td colspan="2">Referrar ID: </td>
				<td> {{ ReferralTableValues::referrarId( $child6['referrar_id'] )}} </td>
			</tr>
			<tr>
				<td colspan="2"> Upline ID: </td>
				<td> {{ ReferralTableValues::uplineId( $child6['upline_id'] )}} </td>
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
				<td> {{ ReferralTableValues::getCarryLeft( $child6['id'] ) }} </td>
				<td> {{ ReferralTableValues::getCarryRight( $child6['id'] ) }}</td>
			</tr>
			<tr>
				<td colspan="3">Joining Date: &nbsp; {{ date('Y-m-d', strtotime( $child6['signup_date'] ))}} </td>
				<td></td>
			</tr>
		</table>
	</div>
{{-- table end --}}