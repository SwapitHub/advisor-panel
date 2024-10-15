@extends('layouts.layout')
@section('content')
<div class="page-body">
	<!-- Container-fluid starts-->
	<div class="container-fluid">
		<div class="page-header">
			<div class="row">
				<div class="col-lg-6">
					<div class="page-header-left">
						<h3>Distributor relationship content
							<small>{{ env('APP_NAME') }} Admin panel</small>
						</h3>
					</div>
				</div>
				<div class="col-lg-6">
					<ol class="breadcrumb pull-right">
						<li class="breadcrumb-item">
							<a href="{{ route('admin.dashboard')  }}">
								<i data-feather="home"></i>
							</a>
						</li>
						<li class="breadcrumb-item">Distributor Relationship</li>
						<li class="breadcrumb-item active">Content</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
	<!-- Container-fluid Ends-->

	<!-- Container-fluid starts-->
	<div class="container-fluid">
		<div class="row">
			<div class="col-xl-12">
				<div class="card tab2-card">
					<div class="card-body">
						<ul class="nav nav-tabs nav-material" id="top-tab" role="tablist">
							<li class="nav-item"><a class="nav-link active" id="top-profile-tab" data-bs-toggle="tab"
								href="#top-profile" role="tab" aria-controls="top-profile"
								aria-selected="true"><i data-feather="info" class="me-2"></i>Distributor Relationship</a>
							</li>
						</ul>
						<div class="tab-content" id="top-tabContent">
							<div class="tab-pane fade show active" id="top-profile" role="tabpanel"
							aria-labelledby="top-profile-tab">
								<form action="{{ route('admin.distributor_relationship.update') }}"
								method="POST" id="profile-form" enctype="multipart/form-data" data-parsley-validate>
									@csrf
                                    <div class="form-group row">
                                        <label for="content" class="col-xl-3 col-md-4"><span></span>content
                                        </label>
                                        <div class="col-md-8">
                                            <textarea class="form-control" id="content" name="content"  rows="8">{{ $list->content }}</textarea>
                                        </div>
                                    </div>

									<div class="pull-left">
										<button type="submit" class="btn btn-primary submitBtn">Save <i
										class="fa fa-spinner fa-spin main-spinner d-none"></i></button>
									</div>
								</form>

							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Container-fluid Ends-->
</div>
@endsection
