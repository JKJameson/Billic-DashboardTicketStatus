<?php
class DashboardTicketStatus {
	public $settings = array(
		'name' => 'Dashboard Ticket Status',
		'description' => 'Shows how many tickets are currently awaiting reply.',
	);
	function dashboard_submodule() {
		global $billic, $db;
		$tickets_awaiting_reply = $db->q('SELECT COUNT(*) FROM `tickets` WHERE `status` = \'Customer-Reply\' OR `status` = \'Open\'');
		$tickets_awaiting_reply = $tickets_awaiting_reply[0]['COUNT(*)'];
        $tickets_in_progress = $db->q('SELECT COUNT(*) FROM `tickets` WHERE `status` = \'In Progress\'');
        $tickets_in_progress = $tickets_in_progress[0]['COUNT(*)'];
        $tickets_answered = $db->q('SELECT COUNT(*) FROM `tickets` WHERE `status` = \'Answered\'');
        $tickets_answered = $tickets_answered[0]['COUNT(*)'];
        $html = '';
        $html .= '<table style="width:100%;margin-top: 20px;text-align:center"><tr>';
        $html .= '<td style="width:33%;font-size:2em"><span class="badge bg-'.($tickets_awaiting_reply==0?'secondary':'danger').'">'.$tickets_awaiting_reply.'</span></td>';
        $html .= '<td style="font-size:2em"><span class="badge bg-'.($tickets_in_progress==0?'secondary':'primary').'">'.$tickets_in_progress.'</span></td>';
        $html .= '<td style="width:33%;font-size:2em"><span class="badge bg-'.($tickets_answered==0?'secondary':'success').'">'.$tickets_answered.'</span></td>';
        $html .= '</tr><tr><td style="padding-top: 10px">Awaiting Reply</td><td style="padding-top: 10px">In Progress</td><td style="padding-top: 10px">Answered</td></tr></table>';
        return array(
            'header' => 'Ticket Status',
            'html' => $html,
        );
	}
}
