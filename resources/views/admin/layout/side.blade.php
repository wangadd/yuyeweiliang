<div class="layui-side layui-side-menu">
    <div class="layui-side-scroll">
        <div class="layui-logo">
            <span>@kongqi('system_name')</span>
        </div>
        <ul class="layui-nav layui-nav-tree" lay-shrink="all" id="LAY-system-side-menu"
            lay-filter="layadmin-system-side-menu">

            @php
                $menu=config('admin_menu');
                //判断插件菜单是否是独立
                $plugin_menu=plugin_admin_menu();

                if(!empty($plugin_menu))
                {
                  foreach ($plugin_menu as $k=>$v)
                  {
                    if($v['show_type']==1)
                    {
                        $menu[$k]=$v['data'];
                    }
                  }
                }

            @endphp
            @foreach($menu as $ik=>$item)
                @if($item['is_hide']!=1)

                    @if(show_hide_menu_auth($item['limit']))
                        <li data-name="{{ $item['name'] }}" class="layui-nav-item ">
                            @if($item['router'])
                            <a lay-href="{{ $item['router']?nroute($item['router'],isset($item['param'])?$item['param']:[]):'javascript:void(0)' }}"
                               lay-tips="{{ $item['name'] }}" lay-direction="2">
                                <i class="layui-side-icon {{ $item['icon'] }}"></i>
                                <cite>{{ $item['name'] }}</cite>
                            </a>
                            @else
                                <a href="{{ $item['router']?nroute($item['router'],isset($item['param'])?$item['param']:[]):'javascript:void(0)' }}"
                                   lay-tips="{{ $item['name'] }}" lay-direction="2">
                                    <i class="layui-side-icon {{ $item['icon'] }}"></i>
                                    <cite>{{ $item['name'] }}</cite>
                                </a>
                            @endif


                            @if(count($item['sub_menus'])>0)
                                <dl class="layui-nav-child">

                                    @foreach($item['sub_menus'] as $sub_v)
                                        @if(show_hide_menu_auth($sub_v['router']))
                                            @if($sub_v['is_hide']!=1)


                                                <dd data-name="{{ $sub_v['title'] }}">
                                                    <a lay-href="{{ nroute($sub_v['router'],isset($sub_v['param'])?$sub_v['param']:[]) }}">
                                                        <i class="layui-side-icon {{ $sub_v['icon'] }}"></i> {{ $sub_v['title'] }}</a>
                                                </dd>

                                            @endif
                                        @endif
                                    @endforeach


                                </dl>

                            @endif
                        </li>

                    @endif
                @endif


            @endforeach
        </ul>


    </div>
</div>