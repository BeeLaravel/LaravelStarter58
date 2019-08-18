<ul class="nav"><!-- 侧边栏 导航 -->
    @foreach ( $menus as $menu_first )
        <li class="nav-header">{{ $menu_first['title'] }}</li>
        @if ( isset($menu_first['children']) )
            @foreach ( $menu_first['children'] as $menu_second )
                <li class="@if ( isset($menu_second['children']) ) has-sub @endif">
                    <a href="{{ !isset($menu_second['children']) ? url('/admin'.$menu_second['slug']) : '#' }}">
                        @if ( isset($menu_second['children']) )<!-- 子集 -->
                            <b class="caret pull-right"></b>
                        @endif
                        @if ( false )
                            <span class="badge pull-right">10</span>
                        @endif
                        @if ( !empty($menu_second['icon']) )<!-- icon -->
                            <i class="{{ $menu_second['icon'] }}"></i>
                        @endif
                        <span>
                            {{ $menu_second['title'] }}
                            @if ( false )
                                <span class="label label-theme m-l-5">NEW</span>
                            @endif
                        </span>
                    </a>
                    @if ( isset($menu_second['children']) )
                        <ul class="sub-menu">
                            @foreach ( $menu_second['children'] as $menu_third )
                                <li class="@if ( isset($menu_third['children']) ) has-sub @endif">
                                    <a href="{{url('/admin'.$menu_third['slug'])}}" @if ( false ) target="_blank" @endif>
                                        @if ( isset($menu_third['children']) )<!-- 子集 -->
                                            <b class="caret pull-right"></b>
                                        @endif
                                        {{ $menu_third['title'] }}
                                        @if ( !empty($menu_third->icon) )<!-- icon -->
                                            <i class="{{ $menu_third->icon }} text-theme m-l-5"></i>
                                        @endif
                                        @if ( false )
                                            <span class="label label-theme m-l-5">NEW</span>
                                        @endif
                                    </a>
                                    @if ( isset($menu_third['children']) )
                                        <ul class="sub-menu">
                                            @foreach ( $menu_third['children'] as $menu_forth )
                                                <li class="@if ( isset($menu_forth['children']) ) has-sub @endif">
                                                    <a href="{{url('/admin'.$menu_forth->slug)}}" @if ( false ) target="_blank" @endif>
                                                        @if ( isset($menu_forth['children']) )<!-- 子集 -->
                                                            <b class="caret pull-right"></b>
                                                        @endif
                                                        {{ $menu_forth['title'] }}
                                                        @if ( !empty($menu_forth['icon']) )<!-- icon -->
                                                            <i class="{{ $menu_forth['icon'] }} text-theme m-l-5"></i>
                                                        @endif
                                                        @if ( false )
                                                            <span class="label label-theme m-l-5">NEW</span>
                                                        @endif
                                                    </a>
                                                     @if ( isset($menu_forth['children']) )
                                                        <ul class="sub-menu">
                                                            @foreach ( $menu_forth['children'] as $menu_fifth )
                                                                <li>
                                                                    <a href="{{url('/admin'.$menu_fifth->slug)}}" @if ( false ) target="_blank" @endif>
                                                                        {{ $menu_fifth->title }}
                                                                        @if ( !empty($menu_fifth['icon']) )<!-- icon -->
                                                                            <i class="{{ $menu_fifth['icon'] }} text-theme m-l-5"></i>
                                                                        @endif
                                                                        @if ( false )
                                                                            <span class="label label-theme m-l-5">NEW</span>
                                                                        @endif
                                                                    </a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
        @endif
    @endforeach
    <li><!-- 最小化侧边栏 -->
        <a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a>
    </li>
</ul>