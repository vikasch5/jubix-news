@extends('backend.common.master')
@section('content')
    <div class="main-content app-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-xl-12">
                    <div class="card custom-card overflow-hidden">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="card-title">
                                Comments List
                            </div>
                            <div class="right-btn">

                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-center">S.No</th>
                                            <th scope="col">News</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Comment</th>
                                        </tr>
                                    </thead>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @if($comments->count() == 0)
                                            <tr>
                                                <td colspan="5" class="text-center">No comments Found</td>
                                            </tr>
                                        @endif
                                        @foreach ($comments as $comment)
                                            <tr>
                                                <th scope="row" class="text-center">
                                                    {{ $loop->iteration }}
                                                </th>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <span class="ms-2">
                                                           <a target="_blank" href="{{ route('news.detail', $comment->news->slug) }}">{{ $comment->news->title }}</a> 
                                                        </span>
                                                    </div>
                                                </td>
                                                <td>{{ $comment->name }}</td>
                                                <td>{{ $comment->email }}</td>
                                                <td>{{ $comment->comment }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="m-4">
                                    {{ $comments->withQueryString()->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection