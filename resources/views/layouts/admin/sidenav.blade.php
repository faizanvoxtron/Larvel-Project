 <aside class="main-sidebar fixed offcanvas shadow" data-toggle='offcanvas'>
     <section class="sidebar">
         <div class="my-3 mx-4 text-center ">
             <a href="{{ route('admin.home') }}">
                 <img src="{{ asset('admin/img/Va_logo.png') }}" class="hide-on-collapse" alt="VoxAccess">
                 <img src="{{ asset('admin/img/Va_logo.png') }}" class="show-on-collapse" alt="VoxAccess">
             </a>
         </div>
         <ul class="sidebar-menu">
             {{-- <li class="header"><strong>MAIN NAVIGATION</strong></li> --}}
             <li>
                 <a href="{{ route('admin.home') }}">
                     <span class="d-inline-block">
                         <i class="icon icon-dashboard2"></i>
                     </span>
                     Home
                 </a>
             </li>
             {{-- <li>
                 <a href="/chatify">
                     <span class="d-inline-block">
                         <i class="icon icon-message"></i>
                     </span>
                     Chats
                 </a>
             </li> --}}

             {{-- <li>
                 <a href="#" class="view_timezones">
                     <span class="d-inline-block">
                         <i class="icon icon-hourglass"></i>
                     </span>
                     View Timezones
                 </a>
             </li> --}}


             {{-- @can('scripts-management')
                 <li>
                     <a href="{{ route('scripts_management-view') }}">
                         <span class="d-inline-block">
                             <i class="icon icon-change_history"></i>
                         </span>
                         Scripts Management
                     </a>
                 </li>
             @endcan --}}


             <li class="treeview">
                 <a href="#">
                     <span class="d-inline-block">
                         <i class="icon icon-file-word-o s-18"></i>
                     </span>
                     Scripts
                     <i class="icon icon-angle-left s-18 pull-right"></i>
                 </a>
                 <ul class="treeview-menu" style="display: none;">

                     <li>
                         <a href="{{ asset('admin/pdfs/bank_tfns.pdf') }}" class="open_script_" target="_blank">
                             <span class="d-inline-block">
                                 <i class="icon icon-credit-card s-18"></i>
                             </span>
                             Bank TFNs
                         </a>
                     </li>
                     @foreach (App\Models\Scripts::where('status', 1)->get() as $key => $script)
                         <li>
                             <a href="{{ asset('storage/' . $script->source) }}" class="open_script_" target="_blank"
                                 data-script="csr">
                                 <span class="d-inline-block">
                                     <i class="icon icon-circle"></i>
                                 </span>
                                 {{ $script->title }}
                             </a>
                         </li>
                     @endforeach
                 </ul>
             </li>



             @can('customer-management')
                 <li class="treeview">
                     <a href="#" class="">
                         <span class="d-inline-block">
                             <i class="icon icon-change_history s-18"></i>
                         </span>
                         Manage Customers
                         <i class="icon icon-angle-left s-18 pull-right"></i>
                     </a>
                     <ul class="treeview-menu" style="display: none;">

                         @can('access-customers')
                             <li>
                                 <a href="{{ route('customer-view') }}">
                                     <span class="d-inline-block">
                                         <i class="icon icon-list4"></i>
                                     </span>
                                     All Customers
                                 </a>
                             </li>
                         @endcan
                         @can('add-customer')
                             <li>
                                 <a href="{{ route('customer-add') }}">
                                     <span class="d-inline-block">
                                         <i class="icon icon-add"></i>
                                     </span>
                                     Add Customer
                                 </a>
                             </li>
                         @endcan
                         @can('access-completed-customers')
                             <li>
                                 <a href="{{ route('customer-completed') }}">
                                     <span class="d-inline-block">
                                         <i class="icon icon-add"></i>
                                     </span>
                                     Completed Customers
                                 </a>
                             </li>
                         @endcan
                         @can('access-re-work-customers')
                             <li>
                                 <a href="{{ route('customer-in_rework') }}">
                                     <span class="d-inline-block">
                                         <i class="icon icon-add"></i>
                                     </span>
                                     Re-work Customers
                                 </a>
                             </li>
                         @endcan

                         @can('access-approved-customers')
                             <li>
                                 <a href="{{ route('approved_customer-view') }}">
                                     <span class="d-inline-block">
                                         <i class="icon icon-add"></i>
                                     </span>
                                     Customer Docs
                                 </a>
                             </li>
                         @endcan

                         @can('access-customers-reapproval')
                             <li>
                                 <a href="{{ route('re_approval_customer-view') }}">
                                     <span class="d-inline-block">
                                         <i class="icon icon-add"></i>
                                     </span>
                                     Re-Approval Customers
                                 </a>
                             </li>
                         @endcan

                         @can('export-customers-as-rcl')
                             <li>
                                 <a href="{{ route('customer_exports-rcl') }}" class="text-danger">
                                     <span class="d-inline-block">
                                         <i class="icon icon-upload"></i>
                                     </span>
                                     RCL Exporter
                                 </a>
                             </li>
                         @endcan

                         @can('export-customer')
                             <li>
                                 <a href="{{ route('customer_exports-view') }}">
                                     <span class="d-inline-block">
                                         <i class="icon icon-add"></i>
                                     </span>
                                     Customers Exports
                                 </a>
                             </li>
                         @endcan
                     </ul>
                 </li>
             @endcan

             @can('access-leadcenter')
                 <li>
                     <a href="{{ route('leadcenter-view') }}">
                         <span class="d-inline-block">
                             <i class="icon icon-dashboard2"></i>
                         </span>
                         Leadcenter
                     </a>
                 </li>
             @endcan
             @can('access-report-request')
                 <li class="treeview">
                     <a href="#">
                         <span class="d-inline-block">
                             <i class="icon icon-change_history s-18"></i>
                         </span>
                         Manage Report Reqs
                         <i class="icon icon-angle-left s-18 pull-right"></i>
                     </a>
                     <ul class="treeview-menu" style="display: none;">
                         <li>
                             <a href="{{ route('report_request-view') }}">
                                 <span class="d-inline-block">
                                     <i class="icon icon-list4"></i>
                                 </span>
                                 All Report Requests
                             </a>
                         </li>
                         @can('add-report-request')
                             <li>
                                 <a href="{{ route('report_request-add') }}">
                                     <span class="d-inline-block">
                                         <i class="icon icon-add"></i>
                                     </span>
                                     Request A Report
                                 </a>
                             </li>
                         @endcan
                     </ul>
                 </li>
             @endcan

             {{-- @can('manage-offices')
                 <li class="treeview">
                     <a href="#">
                         <span class="d-inline-block">
                             <i class="icon icon-change_history s-18"></i>
                         </span>
                         Offices Management
                         <i class="icon icon-angle-left s-18 pull-right"></i>
                     </a>
                     <ul class="treeview-menu" style="display: none;">
                         <li>
                             <a href="{{ route('offices-view') }}">
                                 <span class="d-inline-block">
                                     <i class="icon icon-list4"></i>
                                 </span>
                                 All Offices
                             </a>
                         </li>
                         <li>
                             <a href="{{ route('offices-add') }}">
                                 <span class="d-inline-block">
                                     <i class="icon icon-add"></i>
                                 </span>
                                 Add Office
                             </a>
                         </li>
                     </ul>
                 </li>
             @endcan --}}

             {{-- @can('m-ids-management')
                 <li class="treeview">
                     <a href="#">
                         <span class="d-inline-block">
                             <i class="icon icon-change_history s-18"></i>
                         </span>
                         M Ids Management
                         <i class="icon icon-angle-left s-18 pull-right"></i>
                     </a>
                     <ul class="treeview-menu" style="display: none;">
                         <li>
                             <a href="{{ route('m_ids-view') }}">
                                 <span class="d-inline-block">
                                     <i class="icon icon-list4"></i>
                                 </span>
                                 All M Ids
                             </a>
                         </li>
                         <li>
                             <a href="{{ route('m_ids-add') }}">
                                 <span class="d-inline-block">
                                     <i class="icon icon-add"></i>
                                 </span>
                                 Add M Id
                             </a>
                         </li>
                     </ul>
                 </li>
             @endcan


             @can('access-whitelisted-ips')
                 <li>
                     <a href="{{ route('whitelisted_ips-view') }}">
                         <span class="d-inline-block">
                             <i class="icon icon-block"></i>
                         </span>
                         Whitelisted IPs
                     </a>
                 </li>
             @endcan --}}

             @can('admin-roles')
                 <li class="treeview">
                     <a href="#">
                         <span class="d-inline-block">
                             <i class="icon icon-change_history s-18"></i>
                         </span>
                         User Management
                         <i class="icon icon-angle-left s-18 pull-right"></i>
                     </a>
                     <ul class="treeview-menu" style="display: none;">
                         <li>
                             <a href="{{ route('admin_users-view') }}">
                                 <span class="d-inline-block">
                                     <i class="icon icon-list4"></i>
                                 </span>
                                 All Users
                             </a>
                         </li>
                         @can('manage-role-permissions')
                             <li>
                                 <a href="{{ route('roles.show') }}">
                                     <span class="d-inline-block">
                                         <i class="icon icon-add"></i>
                                     </span>
                                     User Permissions
                                 </a>
                             </li>
                         @endcan
                         {{-- @can('personnel-management')
                             <li>
                                 <a href="{{ route('personnel-view') }}">
                                     <span class="d-inline-block">
                                         <i class="icon icon-add"></i>
                                     </span>
                                     Personnel
                                 </a>
                             </li>
                         @endcan --}}
                     </ul>
                 </li>
             @endcan

             <li class="treeview">
                 <a href="#">
                     <span class="d-inline-block">
                         <i class="icon icon-file-word-o s-18"></i>
                     </span>
                     Logs
                     <i class="icon icon-angle-left s-18 pull-right"></i>
                 </a>
                 <ul class="treeview-menu" style="display: none;">
                     @can('view-customer-phone-modification-logs')
                         <li>
                             <a href="{{ route('customer_phone_modification_logs-view') }}">
                                 <span class="d-inline-block">
                                     <i class="icon icon-circle"></i>
                                 </span>
                                 Customer Phone Modification Logs
                             </a>
                         </li>
                     @endcan

                     @can('view-phone-validation-logs')
                         <li>
                             <a href="{{ route('phone_validation_logs-view') }}">
                                 <span class="d-inline-block">
                                     <i class="icon icon-circle"></i>
                                 </span>
                                 Phone Validation Logs
                             </a>
                         </li>
                     @endcan
                     @can('view-daily-call-logs')
                         <li>
                             <a href="{{ route('external_call_logs-view') }}">
                                 <span class="d-inline-block">
                                     <i class="icon icon-circle"></i>
                                 </span>
                                 Daily Call Logs
                             </a>
                         </li>
                     @endcan
                 </ul>
             </li>
             <li class="treeview">
                 <a href="#">
                     <span class="d-inline-block">
                         <i class="icon icon-gears s-18"></i>
                     </span>
                     Settings
                     <i class="icon icon-angle-left s-18 pull-right"></i>
                 </a>
                 <ul class="treeview-menu" style="display: none;">


                     @can('manage-offices')
                         <li>
                             <a href="{{ route('offices-view') }}">
                                 <span class="d-inline-block">
                                     <i class="icon icon-change_history"></i>
                                 </span>
                                 Offices Management
                             </a>
                         </li>
                     @endcan

                     @can('m-ids-management')
                         <li>
                             <a href="{{ route('m_ids-view') }}">
                                 <span class="d-inline-block">
                                     <i class="icon icon-change_history"></i>
                                 </span>
                                 M Ids Management
                             </a>
                         </li>
                     @endcan

                     @can('scripts-management')
                         <li>
                             <a href="{{ route('scripts_management-view') }}">
                                 <span class="d-inline-block">
                                     <i class="icon icon-change_history"></i>
                                 </span>
                                 Scripts Management
                             </a>
                         </li>
                     @endcan

                     @can('access-whitelisted-ips')
                         <li>
                             <a href="{{ route('whitelisted_ips-view') }}">
                                 <span class="d-inline-block">
                                     <i class="icon icon-block"></i>
                                 </span>
                                 Whitelisted IPs
                             </a>
                         </li>
                     @endcan

                     @can('general-settings')
                         <li>
                             <a href="{{ route('settings') }}">
                                 <span class="d-inline-block">
                                     <i class="icon icon-settings2"></i>
                                 </span>
                                 General Settings
                             </a>
                         </li>
                     @endcan

                 </ul>
             </li>
         </ul>



         </ul>
     </section>
 </aside>
