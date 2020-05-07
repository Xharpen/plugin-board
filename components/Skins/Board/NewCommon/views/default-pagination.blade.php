{{ XeFrontend::css('plugins/board/assets/css/new-board-pagination.css')->load() }}

<div class="xe-list-board--pagination xe-list-board--pagination-pc">
    <ul class="xe-list-board--pagination-list">
        <li class="xe-list-board__pagination-item xe-list-board__btn_pagination xe-list-board__btn_prev"><a class="xe-list-board__pagination-item-link" href="#"><i class="xi-angle-left"></i></a></li>
        <li class="xe-list-board__pagination-item xe-list-board__pagination-number xe-list-board__pagination-number--active"><a class="xe-list-board__pagination-item-link" href="#">1</a></li>
        <li class="xe-list-board__pagination-item xe-list-board__pagination-number"><a class="xe-list-board__pagination-item-link" href="#">2</a></li>
        <li class="xe-list-board__pagination-item xe-list-board__pagination-number"><a class="xe-list-board__pagination-item-link" href="#">3</a></li>
        <li class="xe-list-board__pagination-item xe-list-board__pagination-number"><a class="xe-list-board__pagination-item-link" href="#">4</a></li>
        <li class="xe-list-board__pagination-item xe-list-board__pagination-number"><a class="xe-list-board__pagination-item-link" href="#">5</a></li>
        <li class="xe-list-board__pagination-item xe-list-board__pagination-number"><a class="xe-list-board__pagination-item-link" href="#">6</a></li>
        <li class="xe-list-board__pagination-item xe-list-board__pagination-number"><a class="xe-list-board__pagination-item-link" href="#">7</a></li>
        <li class="xe-list-board__pagination-item xe-list-board__pagination-number"><a class="xe-list-board__pagination-item-link" href="#">8</a></li>
        <li class="xe-list-board__pagination-item xe-list-board__pagination-number"><a class="xe-list-board__pagination-item-link" href="#">9</a></li>
        <li class="xe-list-board__pagination-item xe-list-board__pagination-number"><a class="xe-list-board__pagination-item-link" href="#">10</a></li>
        <li class="xe-list-board__pagination-item xe-list-board__btn_pagination xe-list-board__btn_next"><a class="xe-list-board__pagination-item-link" href="#"><i class="xi-angle-right"></i></a></li>
    </ul>
</div>

<!-- 모바일 -->
<div class="xe-list-board--pagination xe-list-board--pagination-mobile">
    <ul class="xe-list-board--pagination-list">
        <li class="xe-list-board__pagination-item xe-list-board__btn_pagination xe-list-board__btn_prev">
            @if ($paginator->currentPage() <= 1)
                <a class="xe-list-board__pagination-item-link xe-list-board__pagination-item-disabled-link" onclick="return false;"><i class="xi-angle-left"></i></a>
            @else
                <a class="xe-list-board__pagination-item-link" href="{{ $paginator->previousPageUrl() }}"><i class="xi-angle-left"></i></a>
            @endif
        </li>
        <li class="xe-list-board__pagination-item xe-list-board__pagination-box">
            <span class="xe-list-board__pagination-number-present">1</span> / <span class="xe-list-board__pagination-number-total">10</span>
        </li>
        <li class="xe-list-board__pagination-item xe-list-board__btn_pagination xe-list-board__btn_next">
            <a class="xe-list-board__pagination-item-link" href="#"><i class="xi-angle-right"></i></a>
        </li>
    </ul>
</div>
