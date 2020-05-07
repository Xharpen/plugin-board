<div class="panel-group">
    <div class="panel">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <div class="panel-heading">
                        <h4 class="panel-title">{{xe_trans('xe::list')}}</h4>
                    </div>
        
                    <div class="table-responsive item-setting">
                        <table class="table table-sortable">
                            <colgroup>
                                <col style="width: 200px">
                                <col>
                            </colgroup>
                            <tbody>
                            @foreach($config['listColumns'] as $columnName)
                                <tr>
                                    <input type="hidden" name="listColumns[]" value="{{ $columnName }}">
                                    @if (isset($config['dynamicFields'][$columnName]) === false)
                                        <td>
                                            <button class="btn handler"><i class="xi-drag-vertical"></i></button>
                                            <em class="item-title">{{ xe_trans('board::' . $columnName) }}</em>
                                        </td>
                                        <td>
                                            <span class="item-subtext">{{ xe_trans('board::' . $columnName . 'Description') }}</span>
                                        </td>
                                    @else
                                        <td>
                                            <button class="btn handler"><i class="xi-drag-vertical"></i></button>
                                            <em class="item-title">{{ xe_trans($config['dynamicFields'][$columnName]->get('label')) }}</em>
                                        </td>
                                        <td>
                                            <span class="item-subtext"></span>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row" style="padding-top: 30px;">
    <div class="col-sm-12">
        <div class="panel-group">
            <div class="panel">
                <div class="panel-collapse">
                    <div class="panel-heading">
                        <h4 class="panel-title">목록 설정</h4>
                    </div>
                
                    <div class="panel-body">
                        <div class="form-group">
                            <label>게시판 제목 <small> 게시판 제목 스타일을 설정합니다.</small></label>
                            <select class="form-control" name="titleStyle">
                                <option value="titleWithCount" @if (array_get($config, 'titleStyle', 'titleWithCount') === 'titleWithCount') selected @endif>게시판 제목 + 게시물 수</option>
                                <option value="title" @if (array_get($config, 'titleStyle', 'titleWithCount') === 'title') selected @endif>게시판 제목</option>
                                <option value="none" @if (array_get($config, 'titleStyle', 'titleWithCount') === 'none') selected @endif>표시안함</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label>내가 쓴 글<small> 내가 쓴 글만 모아서 볼 수 있습니다.</small></label>
                            <select class="form-control" name="visibleIndexMyBoard">
                                <option value="show" @if (array_get($config, 'visibleIndexMyBoard', 'show') === 'show') selected @endif>표시</option>
                                <option value="hidden" @if (array_get($config, 'visibleIndexMyBoard', 'show') === 'hidden') selected @endif>표시안함</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>글쓰기 버튼<small> 게시물을 작성할 수 있는 버튼입니다.</small></label>
                            <select class="form-control" name="visibleIndexWriteButton">
                                <option value="always" @if (array_get($config, 'visibleIndexWriteButton', 'always') === 'always') selected @endif>항상표시</option>
                                <option value="permission" @if (array_get($config, 'visibleIndexWriteButton', 'always') === 'permission') selected @endif>권한별로 표시</option>
                                <option value="hidden" @if (array_get($config, 'visibleIndexWriteButton', 'always') === 'hidden') selected @endif>표시안함</option>
                            </select>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="visibleIndexMobileWriteButton" value="on" 
                                        @if (array_get($config, 'visibleIndexMobileWriteButton', 'on') === 'on') checked @endif
                                        @if (array_get($config, 'visibleIndexWriteButton', 'always') === 'hidden') disabled @endif>모바일화면에서 상단에도 표시
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>새글 아이콘<small> 새 글 등록시 새글 아이콘이 글제목 뒤에 표시됩니다.</small></label>
                            <select class="form-control" name="visibleIndexNewIcon">
                                <option value="show" @if (array_get($config, 'visibleIndexNewIcon', 'show') === 'show') selected @endif>표시</option>
                                <option value="hidden" @if (array_get($config, 'visibleIndexNewIcon', 'show') === 'hidden') selected @endif>표시안함</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row" style="padding-top: 20px;">
    <div class="col-sm-12">
        <div class="panel-group">
            <div class="panel">
                <div class="panel-collapse">
                    <div class="panel-heading">
                        <h4 class="panel-title">상세화면 설정</h4>
                    </div>
                    
                    <div class="panel-body">
                        <div class="form-group">
                            <label>카테고리</label>
                            <select class="form-control" name="visibleShowCategory">
                                <option value="show" @if (array_get($config, 'visibleShowCategory', 'show') === 'show') selected @endif>표시</option>
                                <option value="hidden" @if (array_get($config, 'visibleShowCategory', 'show') === 'hidden') selected @endif>표시안함</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label>공유하기<small> 소셜서비스 및 링크로 공유할 수 있습니다.</small></label>
                            <select class="form-control" name="visibleShowShare">
                                <option value="show" @if (array_get($config, 'visibleShowShare', 'show') === 'show') selected @endif>표시</option>
                                <option value="hidden" @if (array_get($config, 'visibleShowShare', 'show') === 'hidden') selected @endif>표시안함</option>
                            </select>
                        </div>
                
                        <div class="form-group">
                            <label>북마크<small> 글을 북마크하여 즐겨찾기를 할 수 있습니다.</small></label>
                            <select class="form-control" name="visibleShowFavorite">
                                <option value="show" @if (array_get($config, 'visibleShowFavorite', 'show') === 'show') selected @endif>표시</option>
                                <option value="hidden" @if (array_get($config, 'visibleShowFavorite', 'show') === 'hidden') selected @endif>표시안함</option>
                            </select>
                        </div>
                
                        <div class="form-group">
                            <label>다른글 더보기<small> 다른글 더보기 목록을 사용할 수 있습니다.</small></label>
                            <select class="form-control" name="visibleShowMoreBoardItems">
                                <option value="show" @if (array_get($config, 'visibleShowMoreBoardItems', 'show') === 'show') selected @endif>표시</option>
                                <option value="hidden" @if (array_get($config, 'visibleShowMoreBoardItems', 'show') === 'hidden') selected @endif>표시안함</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function() {
        $('[name=visibleIndexWriteButton]').change(function () {
            if ($(this).val() === 'hidden') {
                $('[name=visibleIndexMobileWriteButton]').prop('checked', false)
                $('[name=visibleIndexMobileWriteButton]').prop('disabled', true)
            } else {
                $('[name=visibleIndexMobileWriteButton]').prop('disabled', false)
            }
        })
        
        // sortable 한 table 구현해야 함
        $(".table-sortable tbody").sortable({
            handle: '.handler',
            cancel: '',
            update: function( event, ui ) {
            },
            start: function(e, ui) {
                ui.placeholder.height(ui.helper.outerHeight());
                ui.placeholder.css("display", "table-row");
                ui.helper.css("display", "table");
            },
            stop: function(e, ui) {
                $(ui.item.context).css("display", "table-row");
            }
        }).disableSelection();

        $('form').bind('submit', function(event) {
            var list = [];

            $('[name="listColumns[]"]').each(function() {
                list.push($(this).val());
            });

            $('[name="sortListColumns[]"]').remove();
            for (var i in list) {
                $(this).append($('<input type="hidden" name="sortListColumns[]">').val(list[i]));
            }
        });
    });
</script>
