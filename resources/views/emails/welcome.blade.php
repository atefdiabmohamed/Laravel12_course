<h2> مرحبا {{ $info['name'] }} </h2>
<p> بريدك الالكتروني {{ $info['email'] }} </p>
<p> مستوي الدورات  {{ $info['level'] }} </p>
<h4> الدورات </h4>
<ul>
@foreach ($info['courses'] as $course )
    <li> {{ $course }}  </li>
@endforeach
</ul>