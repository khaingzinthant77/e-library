@extends('backend.layouts.main')
@section('content')

<link rel="shortcut icon" type="image/x-icon" href="{{asset($e_book->cover_path.$e_book->cover_photo)}}">

<div class="content-wrapper">
    <section class="content-header">
        <h1>Ebook</h1>
        <ol class="breadcrumb">
            <li><a href=""><i class="fa fa-dashboard"></i>Dashboard</a></li>
            <li><a href="{{route('e_books.index')}}">Ebook</a></li>
            <li class="active">View</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-mytheme">
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="profile_view_item">
                            <p><b>Name</b>: {{$e_book->name}}</p>
                        </div>
                        <div class="profile_view_item">
                            <p><b>Category</b>: {{$e_book->cat_name}}</p>
                        </div>
                        
                        <div class="profile_view_item">
                            <p><b>Author</b>: {{$e_book->author_name}}</p>
                        </div>
                        <div class="profile_view_item">
                            <p><b>Notes</b>: {{$e_book->remark}}</p>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div id="pdffile"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@section('js')
<script src="{{asset('assets/custom/js/pdfobject.min.js')}}"></script>
<script type="text/javascript">
    var e_book = <?php print_r(json_encode($e_book)) ?>;
   
    var options = {
        pdfOpenParams: { view: 'Fit', pagemode: 'none', scrollbar: '1', toolbar: '1', statusbar: '1', messages: '1', navpanes: '1' }
    };

    PDFObject.embed(window.location.origin+'/'+ e_book.file_path+e_book.file_name, "#pdffile");
</script>
@endsection
