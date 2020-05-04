{{ XeFrontend::css('plugins/board/assets/css/new-board.css')->load() }}

<div class="xe-list-board-header__contents">
    <form method="get" action="{{ $urlHandler->get('index') }}">
        <div class="xe-list-board-header--left-box">
            <div class="xe-list-board--header__search">
                <input type="text" name="title_content" class="xe-list-board--header__search__control" value="{{ Request::get('title_content') }}">
                <span class="xe-list-board--header__search__icon">
                    <i class="xi-search"></i>
                </span>
            </div>
        </div>
        <div class="xe-list-board-header--right-box">
            <div class="xe-list-board-header--category xe-list-board-header--dropdown-box">
                <div class="xe-list-board-header--dropdown">
                    <div class="xe-list-board-header-category__button xe-list-board-header--dropdown__button">
                        {!! uio('uiobject/board@new_select', [
                            'name' => 'category_item_id',
                            'label' => xe_trans('xe::category'),
                            'value' => Request::get('category_item_id'),
                            'items' => $categories,
                            'open_target' => '.xe-list-board-header--category'
                        ]) !!}
                    </div>
                </div>
            </div>
            <div class="xe-list-board-header--sort xe-list-board-header--dropdown-box">
                <div class="xe-list-board-header--dropdown">
                    <div class="xe-list-board-header-order__button xe-list-board-header--dropdown__button">
                        {!! uio('uiobject/board@new_select', [
                            'name' => 'order_type',
                            'label' => xe_trans('xe::order'),
                            'value' => Request::get('order_type', $config->get('orderType')),
                            'items' => $handler->getOrders(),
                            'open_target' => '.xe-list-board-header-order__button' 
                        ]) !!}
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="xe-list-board-body">
    <ul class="xe-list-board-list--item xe-list-board-list">
        <li class="xe-list-board-list--header">
            @foreach ($skinConfig['listColumns'] as $columnName)
                @if ($columnName === 'favorite')
                    @if (Auth::check() === true)
                        @if (Request::has('favorite'))
                            <div class="xe-list-board-list__favorite"><a href="{{ $urlHandler->get('index', Request::except(['favorite', 'page'])) }}"><i class="xi-star"></i></a></div>
                        @else
                            <div class="xe-list-board-list__favorite"><a href="{{ $urlHandler->get('index', array_merge(Request::except('page'), ['favorite' => 1])) }}"><i class="xi-star-o"></i></a></div>
                        @endif
                    @endif
                @elseif ($columnName === 'title')
                    @if ($config->get('category') === true)
                        <div class="xe-list-board-list__category">{{ xe_trans('board::category') }}</div>
                    @endif
                    <div class="xe-list-board-list__title">{{ xe_trans('board::title') }}</div>
                @else
                    @if (isset($dynamicFieldsById[$columnName]) === true)
                        <div class="xe-list-board-list__dynamic-field xe-list-board-list__dynamic-field-{{ $columnName }}">{{ xe_trans($dynamicFieldsById[$columnName]->get('label')) }}</div> 
                    @else
                        <div class="xe-list-board-list__{{ $columnName }}">{{ xe_trans('board::' . $columnName) }}</div>
                    @endif
                @endif
            @endforeach
        </li>

        @foreach ($notices as $item)
            <li class="xe-list-board-list--item xe-list-board-list--item-notice">
                @foreach ($skinConfig['listColumns'] as $columnName)
                    @switch ($columnName)
                        @case ('favorite')
                            <div class="xe-list-board-list__favorite xe-hidden-mobile">
                                <a href="#" data-url="{{ $urlHandler->get('favorite', ['id' => $item->id]) }}" class="@if ($item->favorite !== null) on @endif __xe-bd-favorite"  title="{{xe_trans('board::favorite')}}"><i class="xi-star"></i></a>
                            </div>
                            @break

                        @case ('title')
                            @if ($config->get('category') === true)
                                <div class="xe-list-board-list__category">
                                    <span class="xe-list-board-list__text">
                                        {!! $item->boardCategory !== null ? xe_trans($item->boardCategory->categoryItem->word) : '' !!}
                                    </span>
                                </div>
                            @endif
                            <div class="xe-list-board-list__title">
                                <a href="{{ $urlHandler->getShow($item, Request::all()) }}" class="xe-list-board-list__title-link">
                                    <span class="xe-list-board-list__notice--box-form"><span class="xe-list-board-list__notice--box-form-bg">공지</span></span>
                                    @if ($item->display == $item::DISPLAY_SECRET)
                                        <span class="xe-list-board-list__subjec-secret"><i class="xi-lock"></i></span>
                                    @endif
                                    <span class="xe-list-board-list__title-text">{{ $item->title }}</span>
                                    <div class="xe-list-board-list__title-icon">
                                        @if($item->comment_count > 0)
                                            <span class="xe-list-board-list__title-comment_count">{{ $item->comment_count }}</span>
                                        @endif
                                        @if ($item->data->file_count > 0)
                                            <span class="xe-list-board-list__title-file"><i class="xi-paperclip"></i><span class="blind">첨부파일</span></span>
                                        @endif
                                        @if( $item->isNew($config->get('newTime')) )
                                            <span class="xe-list-board-list__title-new"><span class="blind">새글</span></span>
                                        @endif
                                    </div>
                                </a>
                            </div>
                            @break
                        @case ('writer')
                            <div class="xe-list-board-list__writer">
                                @if ($item->hasAuthor() && $config->get('anonymity') === false)
                                    <a href="#" class="mb_author"
                                       data-toggle="xe-page-toggle-menu"
                                       data-url="{{ route('toggleMenuPage') }}"
                                       data-data='{!! json_encode(['id'=>$item->getUserId(), 'type'=>'user']) !!}'>
                                        <span class="xe-list-board-list__user-image xe-hidden-mobile" style="background: url({{ $item->user->getProfileImage() }});"><span class="blind">유저 이미지</span></span>
                                        <span class="xe-list-board-list__display_name xe-list-board-list__mobile-style">{{ $item->writer }}</span>
                                    </a>
                                @else
                                    <a href="#">
                                        <span class="xe-list-board-list__user-image xe-hidden-mobile"><span class="blind">유저 이미지</span></span>
                                        <span class="xe-list-board-list__display_name xe-list-board-list__mobile-style">{{ $item->writer }}</span>
                                    </a>
                                @endif
                            </div>
                            @break

                        @case ('created_at')
                        @case ('updated_at')
                        @case ('published_at')
                            <div class="xe-list-board-list__{{ $columnName }} xe-list-board-list__mobile-style"><span class="xe-hidden-pc">{{ xe_trans('board::' . $columnName) }}</span> {{ $item->{$columnName}->format('Y. m. d.') }}</div>
                            @break

                        @case ('read_count')
                        @case ('assent_count')
                        @case ('dissent_count')
                            <div class="xe-list-board-list__{{ $columnName }} xe-list-board-list__mobile-style"><span class="xe-hidden-pc">{{ xe_trans('board::' . $columnName) }}</span> {{ number_format($item->{$columnName}) }}</div>
                            @break

                        @default
                            @if (($fieldType = XeDynamicField::get($config->get('documentGroup'), $columnName)) !== null)
                                <div class="xe-list-board-list__dynamic-field xe-list-board-list__dynamic-field-{{ $columnName }} xe-list-board-list__mobile-style">
                                    <span class="xe-hidden-pc">{{ xe_trans($dynamicFieldsById[$columnName]->get('label')) }}</span>
                                    {!! $fieldType->getSkin()->output($columnName, $item->getAttributes()) !!}
                                </div>
                            @else
{{--                                TODO 기본 출력 내용 스타일 필요--}}
                                {!! $item->{$columnName} !!}
                            @endif
                            @break
                    @endswitch
                @endforeach
            </li>
        @endforeach
        
        @foreach ($paginate as $item)
            <li class="xe-list-board-list--item">
                @foreach ($skinConfig['listColumns'] as $columnName)
                    @switch ($columnName)
                        @case ('favorite')
                        <div class="xe-list-board-list__favorite xe-hidden-mobile">
                            <a href="#" data-url="{{ $urlHandler->get('favorite', ['id' => $item->id]) }}" class="@if ($item->favorite !== null) on @endif __xe-bd-favorite"  title="{{xe_trans('board::favorite')}}"><i class="xi-star"></i></a>
                        </div>
                        @break

                        @case ('title')
                        @if ($config->get('category') === true)
                            <div class="xe-list-board-list__category">
                                    <span class="xe-list-board-list__text">
                                        {!! $item->boardCategory !== null ? xe_trans($item->boardCategory->categoryItem->word) : '' !!}
                                    </span>
                            </div>
                        @endif
                        <div class="xe-list-board-list__title">
                            <a href="{{ $urlHandler->getShow($item, Request::all()) }}" class="xe-list-board-list__title-link">
                                @if ($item->display == $item::DISPLAY_SECRET)
                                    <span class="xe-list-board-list__subjec-secret"><i class="xi-lock"></i></span>
                                @endif
                                <span class="xe-list-board-list__title-text">{{ $item->title }}</span>
                                <div class="xe-list-board-list__title-icon">
                                    @if($item->comment_count > 0)
                                        <span class="xe-list-board-list__title-comment_count">{{ $item->comment_count }}</span>
                                    @endif
                                    @if ($item->data->file_count > 0)
                                        <span class="xe-list-board-list__title-file"><i class="xi-paperclip"></i><span class="blind">첨부파일</span></span>
                                    @endif
                                    @if( $item->isNew($config->get('newTime')) )
                                        <span class="xe-list-board-list__title-new"><span class="blind">새글</span></span>
                                    @endif
                                </div>
                            </a>
                        </div>
                        @break
                        @case ('writer')
                        <div class="xe-list-board-list__writer">
                            @if ($item->hasAuthor() && $config->get('anonymity') === false)
                                <a href="#" class="mb_author"
                                   data-toggle="xe-page-toggle-menu"
                                   data-url="{{ route('toggleMenuPage') }}"
                                   data-data='{!! json_encode(['id'=>$item->getUserId(), 'type'=>'user']) !!}'>
                                    <span class="xe-list-board-list__user-image xe-hidden-mobile" style="background: url({{ $item->user->getProfileImage() }});"><span class="blind">유저 이미지</span></span>
                                    <span class="xe-list-board-list__display_name xe-list-board-list__mobile-style">{{ $item->writer }}</span>
                                </a>
                            @else
                                <a href="#">
                                    <span class="xe-list-board-list__user-image xe-hidden-mobile"><span class="blind">유저 이미지</span></span>
                                    <span class="xe-list-board-list__display_name xe-list-board-list__mobile-style">{{ $item->writer }}</span>
                                </a>
                            @endif
                        </div>
                        @break

                        @case ('created_at')
                        @case ('updated_at')
                        @case ('published_at')
                        <div class="xe-list-board-list__{{ $columnName }} xe-list-board-list__mobile-style"><span class="xe-hidden-pc">{{ xe_trans('board::' . $columnName) }}</span> {{ $item->{$columnName}->format('Y. m. d.') }}</div>
                        @break

                        @case ('read_count')
                        @case ('assent_count')
                        @case ('dissent_count')
                        <div class="xe-list-board-list__{{ $columnName }} xe-list-board-list__mobile-style"><span class="xe-hidden-pc">{{ xe_trans('board::' . $columnName) }}</span> {{ number_format($item->{$columnName}) }}</div>
                        @break

                        @default
                        @if (($fieldType = XeDynamicField::get($config->get('documentGroup'), $columnName)) !== null)
                            <div class="xe-list-board-list__dynamic-field xe-list-board-list__dynamic-field-{{ $columnName }} xe-list-board-list__mobile-style">
                                <span class="xe-hidden-pc">{{ xe_trans($dynamicFieldsById[$columnName]->get('label')) }}</span>
                                {!! $fieldType->getSkin()->output($columnName, $item->getAttributes()) !!}
                            </div>
                        @else
{{--                                TODO 기본 출력 내용 스타일 필요--}}
                            {!! $item->{$columnName} !!}
                        @endif
                        @break
                    @endswitch
                @endforeach
            </li>
        @endforeach
        
        @if ($paginate->total() === 0)
            <div class="xe-list-blog-board-body">
                <span class="xe-list-blog-board__text">등록된 게시물이 없습니다.</span>
            </div>
        @endif
    </ul>
</div>

<div class="xe-list-board-footer">
    <div class="xe-list-board--button-box">
        @if ($isManager === true)
            <div class="xe-list-board--btn-left-box">
                <a href="{{ $urlHandler->managerUrl('config', ['boardId' => $instanceId]) }}" class="xe-list-board__btn xe-list-board__btn-primary" target="_blank">관리</a>
            </div>
        @endif
        <div class="xe-list-board--btn-right-box">
            @if (Auth::check() === true)
                <a href="{{ $urlHandler->get('index', ['user_id' => Auth::user()->getId()]) }}" class="xe-list-board__btn">내가 쓴 글</a>
            @endif
            <a href="{{ $urlHandler->get('create') }}" class="xe-list-board__btn">글쓰기</a>
        </div>
    </div>
</div>

{!! $paginate->render($_skin::view('default-pagination')) !!}
