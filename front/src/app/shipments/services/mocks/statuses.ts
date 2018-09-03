import { Status } from "../../models/status";
import { StatusGroup } from "../../models/status-group";

export const STATUS_GROUPS: StatusGroup[] = [
  { code: 'all', title: 'Todos', icon:'fa-align-justify'},
  { code: 'in_transit', title: 'En tránsito', icon: 'fa-truck' },
  { code: 'in_process', title: 'En proceso', icon: 'fa-tasks' },
  { code: 'delayed', title: 'Demorado', icon: 'fa-clock' },
  { code: 'alert', title: 'Alert', icon: 'fa-exclamation-triangle' },
  { code: 'returned', title: 'Devuelto', icon: 'fa-undo' }
];

export const STATUSES: Status[] = [

  { code: '000', title: 'Status Not Available', tags: ['alert'] },
  { code: '003', title: 'Order Processed: Ready for UPS', tags: ['in_process'] },
  { code: '005', title: 'In Transit', tags: ['in_transit'] },
  { code: '006', title: 'On Vehicle for Delivery', tags: ['in_transit'] },
  { code: '007', title: 'Shipment Information Voided', tags: ['in_transit'] },
  { code: '010', title: 'In Transit: On Time', tags: ['in_transit'] },
  { code: '011', title: 'Delivered', tags: ['delivered'] },
  { code: '012', title: 'Clearance in Progress', tags: ['in_process'] },
  { code: '013', title: 'Exception', tags: ['alert'] },
  { code: '014', title: 'Clearance Completed', tags: ['in_transit'] },
  { code: '016', title: 'Held in Warehouse', tags: ['delayed'] },
  { code: '017', title: 'Held for Customer Pickup', tags: ['delayed'] },
  { code: '018', title: 'Delivery Change Requested: Hold for Pickup', tags: ['alert'] },
  { code: '019', title: 'Held for Future Delivery', tags: ['delayed'] },
  { code: '020', title: 'Held for Future Delivery Requested', tags: ['delayed'] },
  { code: '021', title: 'On Vehicle for Delivery Today', tags: ['in_transit'] },
  { code: '022', title: 'First Attempt Made', tags: ['alert'] },
  { code: '023', title: 'Second Attempt Made', tags: ['alert'] },
  { code: '024', title: 'Final Attempt Made', tags: ['alert'] },
  { code: '025', title: 'Transferred to Local Post Office for Delivery', tags: ['alert'] },
  { code: '026', title: 'Delivered by Local Post Office', tags: ['alert'] },
  { code: '027', title: 'Delivery Address Change Requested', tags: ['alert'] },
  { code: '028', title: 'Delivery Address Changed', tags: ['alert'] },
  { code: '029', title: 'Exception: Action Required', tags: ['alert'] },
  { code: '030', title: 'Local Post Office Exception', tags: ['alert'] },
  { code: '032', title: 'Adverse Weather May Cause Delay', tags: ['delayed'] },
  { code: '033', title: 'Return to Sender Requested', tags: ['returned'] },
  { code: '034', title: 'Returned to Sender', tags: ['returned'] },
  { code: '035', title: 'Returning to Sender', tags: ['returned'] },
  { code: '036', title: 'Returning to Sender: In Transit', tags: ['returned'] },
  { code: '037', title: 'Returning to Sender: On Vehicle for Delivery', tags: ['returned'] },
  { code: '038', title: 'Picked Up', tags: ['delivered'] },
  { code: '039', title: 'In Transit by Post Office', tags: ['in_transit'] },
  { code: '040', title: 'Delivered to UPS Access Point Awaiting Customer Pickup', tags: ['delayed'] },
  { code: '041', title: 'Service Upgrade Requested', tags: ['alert'] },
  { code: '042', title: 'Service Upgraded', tags: ['alert'] },
  { code: '043', title: 'Voided Pickup', tags: ['voided'] },
  { code: '044', title: 'In Transit to UPS', tags: ['in_transit'] },
  { code: '045', title: 'Order Processed: In Transit to UPS', tags: ['in_process'] },
  { code: '046', title: 'Delay', tags: ['delayed'] },
  { code: '047', title: 'Delay', tags: ['delayed'] },
  { code: '048', title: 'Delay', tags: ['delayed'] },
  { code: '049', title: 'Delay: Action Required', tags: ['delayed'] },
  { code: '050', title: 'Address Information Required', tags: ['alert'] },
  { code: '051', title: 'Delay: Emergency Situation or Severe Weather', tags: ['delayed'] },
  { code: '052', title: 'Delay: Severe Weather', tags: ['delayed'] },
  { code: '053', title: 'Delay: Severe Weather, Recovery in Progress', tags: ['delayed'] },
  { code: '054', title: 'Delivery Change Requested', tags: ['alert'] },
  { code: '055', title: 'Rescheduled Delivery', tags: ['delayed'] },
  { code: '056', title: 'Service Upgrade Requested', tags: ['alert'] },
  { code: '057', title: 'In Transit to a UPS Access Point', tags: ['in_transit'] },
  { code: '058', title: 'Clearance Information Required', tags: ['alert'] },
  { code: '059', title: 'Damage Reported', tags: ['alert'] },
  { code: '060', title: 'Delivery Attempted', tags: ['alert'] },
  { code: '061', title: 'Delivery Attempted: Adult Signature Required', tags: ['alert'] },
  { code: '062', title: 'Delivery Attempted: Funds Required', tags: ['alert'] },
  { code: '063', title: 'Delivery Change Completed', tags: ['delivered'] },
  { code: '064', title: 'Delivery Refused', tags: ['alert'] },
  { code: '065', title: 'Pickup Attempted', tags: ['alert'] },
  { code: '066', title: 'Post Office Delivery Attempted', tags: ['alert'] },
  { code: '067', title: 'Returned to Sender by Post Office', tags: ['returned'] },
  { code: '068', title: 'Sent to Lost and Found', tags: ['returned'] },
  { code: '069', title: 'Package Not Claimed', tags: ['alert'] },
  { code: '068', title: 'Sent to Lost and Found ', tags: ['returned'] },
  { code: '069', title: 'Package Not Claimed ', tags: ['alert'] },
];