{!! $content !!}

<div style="text-align: center;padding-top: 20px;margin-top: 20px;border-top: 1px solid #ddd;">
    <a style="text-decoration: none; color: #17a2b8; text-transform: uppercase;font-size: 12px;" href="{{ config('app.url') }}/unsubscribe?email={{ $mail }}&amp;code={{ $code }}">
        Wypisz się z newslettera
    </a>
</div>