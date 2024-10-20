@extends('header')

@section('content')
    @php
        $springFlg=false;
        $summerFlg=false;
        $autumnFlg=false;
        $winterFlg=false;
        foreach($seasons->productSeason as $season){
            $selectedSeason = $season->season_id;
            switch($selectedSeason){
                case 1:
                    $springFlg=true;
                    break;
                case 2:
                    $summerFlg=true;
                    break;
                case 3:
                    $autumnFlg=true;
                    break;
                case 4:
                    $winterFlg=true;
                    break;
            }
        }
    @endphp
    <div class="flex flex-col">
        <div class="w-[60%] mx-auto">
            <form action="{{'/products/'.$fruit->id.'/update'}}" method="post" enctype="multipart/form-data">
                @csrf
                <div>
                    <a href="/products" class="text-blue-400">商品一覧</a> > {{$fruit->name}}
                </div>
                <!-- 商品詳細入力 -->
                <div class="flex flex-raw mt-4">
                    <div class="w-[50%] mr-4">
                        @if ($errors->has('image'))
                            <input type="file" class="mb-4 mt-auto py-2 rounded-[5px]" name="image">
                            <div class="text-red-500">
                                {{ $errors->first('image') }}
                            </div>
                        @else
                            <img src="{{ asset($fruit->image)}}" alt="test" class="w-full">
                            <input type="file" class="mb-4 mt-auto py-2 rounded-[5px]" name="image">
                        @endif
                    </div>
                    <div class="w-[50%] ml-4">
                        <p>商品名</p>
                        <input type="hidden" name="id" value="{{$fruit->id}}">
                        @if ($errors->has('name'))
                            <input type="text" name="name" value="" class="w-full h-[40px] my-2 rounded-[5px] border border-gray-300" placeholder="商品名を入力">
                            <div class="text-red-500">
                                {{ $errors->first('name') }}
                            </div>
                        @else
                            <input type="text" name="name" value="{{$fruit->name}}" class="w-full h-[40px] my-2 rounded-[5px] border border-gray-300">
                        @endif
                        <p class="mt-8">値段</p>
                        @if ($errors->has('price'))
                            <input type="text" name="price" value="" class="w-full h-[40px] my-2 rounded-[5px] border border-gray-300" placeholder="値段を入力">
                            <div class="text-red-500">
                                {{ $errors->first('price') }}
                            </div>
                        @else
                            <input type="text" name="price" value="{{$fruit->price}}" class="w-full h-[40px] my-2 rounded-[5px] border border-gray-300">
                        @endif
                        <p class="mt-8">季節</p>
                        <div class="flex item-center">
                            <input type="checkbox" name="spring" value="spring" class="w-6 h-6 mr-2" @if($springFlg) checked @endif>春
                            <input type="checkbox" name="summer" value="summer" class="w-6 h-6 ml-4 mr-2" @if($summerFlg) checked @endif>夏
                            <input type="checkbox" name="autumn" value="autumn" class="w-6 h-6 ml-4 mr-2" @if($autumnFlg) checked @endif>秋
                            <input type="checkbox" name="winter" value="winter" class="w-6 h-6 ml-4 mr-2" @if($winterFlg) checked @endif>冬
                        </div>
                        @if ($errors->has('season'))
                            <div class="text-red-500">
                                {{ $errors->first('season') }}
                            </div>
                        @endif
                    </div>
                </div>
                <!-- 商品説明入力欄 -->
                <p>商品説明</p>
                @if ($errors->has('description'))
                    <textarea cols="100" rows="5" maxlength="120" class="w-full mt-4 border border-gray-300 resize-none" placeholder="商品の説明を入力"></textarea>
                    <div class="text-red-500">
                        {{ $errors->first('description') }}
                    </div>
                @else
                    <textarea cols="100" rows="5" maxlength="120" name="description" class="w-full mt-4 border border-gray-300 resize-none">{{$fruit->description}}</textarea>
                @endif
                <!-- formボタン -->
                <div class="relative w-full mt-8 flex justify-center">
                    <div class="flex space-x-4">
                        <a href="/products" class="w-[150px] px-4 py-2 bg-gray-300 rounded-m text-center">戻る</a>
                        <input type="submit" name="save" value="変更を保存" class="w-[150px] px-4 py-2 bg-yellow-400 rounded-md">
                    </div>
                    
                    <a href="{{'/products/'.$fruit->id.'/delete'}}">
                        <svg class="absolute right-0 top-0 mr-4 mt-1" width="21" height="23" viewBox="0 0 21 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M19 4.33325H17.6667V2.99992C17.6667 1.52792 16.472 0.333252 15 0.333252H5.66671C4.19471 0.333252 3.00004 1.52792 3.00004 2.99992V4.33325H1.66671C0.930707 4.33325 0.333374 4.93058 0.333374 5.66658C0.333374 6.40259 0.930707 6.99992 1.66671 6.99992V17.6666C1.66671 20.6079 4.05871 22.9999 7.00004 22.9999H13.6667C16.608 22.9999 19 20.6079 19 17.6666V6.99992C19.736 6.99992 20.3334 6.40259 20.3334 5.66658C20.3334 4.93058 19.736 4.33325 19 4.33325ZM5.66671 2.99992H15V4.33325H5.66671V2.99992ZM16.3334 17.6666C16.3334 19.1386 15.1387 20.3333 13.6667 20.3333H7.00004C5.52804 20.3333 4.33337 19.1386 4.33337 17.6666V6.99992H16.3334V17.6666ZM6.33337 8.99992C5.96671 8.99992 5.66671 9.29992 5.66671 9.66658V17.6666C5.66671 18.0333 5.96671 18.3333 6.33337 18.3333C6.70004 18.3333 7.00004 18.0333 7.00004 17.6666V9.66658C7.00004 9.29992 6.70004 8.99992 6.33337 8.99992ZM9.00004 8.99992C8.63337 8.99992 8.33337 9.29992 8.33337 9.66658V17.6666C8.33337 18.0333 8.63337 18.3333 9.00004 18.3333C9.36671 18.3333 9.66671 18.0333 9.66671 17.6666V9.66658C9.66671 9.29992 9.36671 8.99992 9.00004 8.99992ZM11.6667 8.99992C11.3 8.99992 11 9.29992 11 9.66658V17.6666C11 18.0333 11.3 18.3333 11.6667 18.3333C12.0334 18.3333 12.3334 18.0333 12.3334 17.6666V9.66658C12.3334 9.29992 12.0334 8.99992 11.6667 8.99992ZM14.3334 8.99992C13.9667 8.99992 13.6667 9.29992 13.6667 9.66658V17.6666C13.6667 18.0333 13.9667 18.3333 14.3334 18.3333C14.7 18.3333 15 18.0333 15 17.6666V9.66658C15 9.29992 14.7 8.99992 14.3334 8.99992Z" fill="#FD0707"/>
                        </svg>
                    </a>
                </div>
            </form>
        </div>
        
    </div>
@endsection