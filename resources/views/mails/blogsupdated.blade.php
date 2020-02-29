@component('mail::message')
# Introduction

{{$blog->description}}.

@component('mail::button', ['url' => ''])
View
@endcomponent

Thanks,<br>
Admin Team
@endcomponent
