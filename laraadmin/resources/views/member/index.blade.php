<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('List Member') }}
        </h2>
    </x-slot>

    <div class="py-12">
    
     <link href="https://unpkg.com/tailwindcss/dist/tailwind.min.css" rel="stylesheet">
	 <!--Regular Datatables CSS-->
	 <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
	 <!--Responsive Extension Datatables CSS-->
	 <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
     <style>
        @import url(https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.3.45/css/materialdesignicons.min.css);
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;800&display=swap');
        body {
            font-family: 'Poppins', sans-serif;
        }
        .active\:bg-grey-900:active {
            --tw-bg-opacity: 1;
            background-color: rgba(17, 24, 39,var(--tw-bg-opacity));
        }
        .hover\:border-4:hover {
            border-width: 4px;
        }
        .hover\:m-0:hover {
            margin: 0;
        }
        .focus\:border-4:focus {
            border-width: 4px;
        }
        .focus\:m-0:focus {
            margin: 0;
        }
        .active\:border-grey-900:active {
            --tw-bg-opacity: 1;
            border-color: rgba(17, 24, 39,var(--tw-bg-opacity));
        }
        .active\:text-grey-900:active {
            --tw-bg-opacity: 1;
            color: rgba(17, 24, 39,var(--tw-bg-opacity));
        }
        .active\:border-transparent:active {
            border-color: transparent;
        }
		.dataTables_wrapper select,
		.dataTables_wrapper .dataTables_filter input {
			color: #4a5568; 			/*text-gray-700*/
			padding-left: 1rem; 		/*pl-4*/
			padding-right: 1rem; 		/*pl-4*/
			padding-top: .5rem; 		/*pl-2*/
			padding-bottom: .5rem; 		/*pl-2*/
			line-height: 1.25; 			/*leading-tight*/
			border-width: 2px; 			/*border-2*/
			border-radius: .25rem; 		
			border-color: #edf2f7; 		/*border-gray-200*/
			background-color: #edf2f7; 	/*bg-gray-200*/
		}

		/*Row Hover*/
		table.dataTable.hover tbody tr:hover, table.dataTable.display tbody tr:hover {
			background-color: #ebf4ff;	/*bg-indigo-100*/
		}
		
		/*Pagination Buttons*/
		.dataTables_wrapper .dataTables_paginate .paginate_button		{
			font-weight: 700;				/*font-bold*/
			border-radius: .25rem;			/*rounded*/
			border: 1px solid transparent;	/*border border-transparent*/
		}
		
		/*Pagination Buttons - Current selected */
		.dataTables_wrapper .dataTables_paginate .paginate_button.current	{
			color: #fff !important;				/*text-white*/
			box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06); 	/*shadow*/
			font-weight: 700;					/*font-bold*/
			border-radius: .25rem;				/*rounded*/
			background: #667eea !important;		/*bg-indigo-500*/
			border: 1px solid transparent;		/*border border-transparent*/
		}

		/*Pagination Buttons - Hover */
		.dataTables_wrapper .dataTables_paginate .paginate_button:hover		{
			color: #fff !important;				/*text-white*/
			box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06);	 /*shadow*/
			font-weight: 700;					/*font-bold*/
			border-radius: .25rem;				/*rounded*/
			background: #667eea !important;		/*bg-indigo-500*/
			border: 1px solid transparent;		/*border border-transparent*/
		}
		
		/*Add padding to bottom border */
		table.dataTable.no-footer {
			border-bottom: 1px solid #e2e8f0;	/*border-b-1 border-gray-300*/
			margin-top: 0.75em;
			margin-bottom: 0.75em;
		}
		
		/*Change colour of responsive icon*/
		table.dataTable.dtr-inline.collapsed>tbody>tr>td:first-child:before, table.dataTable.dtr-inline.collapsed>tbody>tr>th:first-child:before {
			background-color: #667eea !important; /*bg-indigo-500*/
		}
		
      </style>
	  
 

   </head>
   <body class="bg-gray-100 text-gray-900 tracking-wider leading-normal">
      

      <!--Container-->
      <div class="container w-full md:w-4/5 xl:w-3/5  mx-auto px-2">
			
			<!--Card-->
			 <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
			 
				
				<table id="example" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
					<thead>
						<tr>
							<th data-priority="1">Nama</th>
							<th data-priority="2">No WA</th>
							<th data-priority="3">Alamat</th>
							<th data-priority="4" colspan="2">Opsi</th>
						</tr>
					</thead>
                    @foreach($member as $m)
					<tbody>
						<tr>
							<td>{{ $m->name }}</td>
							<td>{{ $m->phone }}</td>
							<td>{{ $m->address }}</td>
                            <td>
                            <x-nav-link :href="route('member.edit', $m->id)" :active="request()->routeIs('member.edit', $m->id)" >Edit</x-nav-link>
                            </td>
                            <td>
                                <form action="{{ route('member.destroy', $m->id) }}" method="post">
                                <x-nav-link action="route('member.destroy', $m->id)" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Hapus</button>
                                </x-nav-link>
                            </td>
						</tr>
					</tbody>
                    @endforeach
					
				</table>
				
				
			</div>
			<!--/Card-->


      </div>
      <!--/container-->
	  
	  



	<!-- jQuery -->
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
		
	<!--Datatables -->
	<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
	<script>
		$(document).ready(function() {
			
			var table = $('#example').DataTable( {
					responsive: true
				} )
				.columns.adjust()
				.responsive.recalc();
		} );
	
	</script>
    </div>
</x-app-layout>