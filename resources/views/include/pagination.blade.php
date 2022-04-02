@if ($paginator->lastPage() > 1)
    <div class="pagination-wrapper">
        <ul class="pagination pagination-circle mg-b-0">
            @if($paginator->currentPage() > 1)
                <li class="page-item hidden-xs-down {{ ($paginator->currentPage() == 1) ? ' disabled' : '' }}">
                    <a class="page-link" href="{{ $paginator->url(1) }}" aria-label="First"><i
                            class="fa fa-angle-double-left"></i></a>
                </li>
                <li class="page-item ">
                    <a class="page-link" href="{{ $paginator->url($paginator->currentPage() - 1) }}"
                       aria-label="Previous"><i class="fa fa-angle-left"></i></a>
                </li>
            @endif
            @php
                $pagebreak = 5;
                $startpage = 1;
                if($paginator->currentPage() > 1){
                   $startpage = $paginator->currentPage();
                   $pagebreak = $pagebreak + $startpage - 1;
                   if (($startpage-3) >= 1){
                       $startpage = $startpage-3;
                   }else{
                       $startpage = 1;
                   }
                }
            @endphp

            @for ($i = $startpage; $i <= $paginator->lastPage(); $i++)
                @if($i < $pagebreak || $i == $paginator->lastPage())
                    <li class="page-item {{ ($paginator->currentPage() == $i) ? ' active' : '' }}">
                        <a class="page-link" href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
                @elseif($i == $pagebreak)
                    <li class="page-item disabled"><span class="page-link">...</span></li>
                @endif

            @endfor

            {{--            <li class="page-item"><a class="page-link" href="#">2</a></li>--}}
            {{--            <li class="page-item hidden-xs-down"><a class="page-link" href="#">3</a></li>--}}
            {{--            <li class="page-item hidden-xs-down"><a class="page-link" href="#">4</a></li>--}}
            {{--            <li class="page-item disabled"><span class="page-link">...</span></li>--}}
            {{--            <li class="page-item"><a class="page-link" href="#">10</a></li>--}}



            @if($paginator->currentPage() < $paginator->lastPage())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->url($paginator->currentPage() + 1) }}" aria-label="Next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </li>
                <li class="page-item hidden-xs-down">
                    <a class="page-link" href="{{ $paginator->url($paginator->lastpage()) }}" aria-label="Last">
                        <i class="fa fa-angle-double-right"></i>
                    </a>
                </li>
            @endif
        </ul>
    </div>
@endif








