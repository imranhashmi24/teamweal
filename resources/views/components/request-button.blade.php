@props(['route' => '', 'text' => '', 'type' => 'frontend', 'id'=> 1])

<a href="{{ route($route, ['id' => $id, 'type' => $type]) }}" class="btn btn-custom mt-auto">{{ __($text) }}</a>

@push('style')
    <style>
        .request-btn {
            text-align: center;
            align-items: center;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            outline: none;
            background: transparent;
            border-radius: 8px;
            border: 1px solid rgba(119, 79, 157, 1);
            font-size: 14px;
            color: #181616;
            text-decoration: none;
            padding: 9px 10px;
            width: 200px;
            margin: 10px 50px 20px 60px !important;
        }


        .request-btn:hover {
            background: var(--wc);
            color: var(--bc);
        }

        @media only screen and (max-width: 767px) {
            .request-btn {
                width: 85%;
                font-size: 12px;
                padding: 5px 5px;
                margin: 8px 15px 15px 15px !important;
            }
        }
    </style>
@endpush
