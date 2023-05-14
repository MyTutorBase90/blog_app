<a href="{{url('/blog/'.$model->slug.'/detail')}}" class="btn btn-sm btn-info"><i class="fa fa-eye"></i> Detail</a>
<a href="{{url('/blog/'.$model->slug.'/edit')}}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i> Edit</a>
<a onclick="delete_blog('{{$model->slug}}')" class="btn btn-sm btn-danger" style="color: whitesmoke"><i class="fa fa-trash" style="color: whitesmoke"></i> Delete</a>
