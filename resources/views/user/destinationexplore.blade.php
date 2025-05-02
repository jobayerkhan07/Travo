@extends('layouts.customerlayout')


@section('title', 'Explore Hotels')

@section('content')






 <!-- Footer Section -->
 <footer>
  <div class="footer-content">
      <div class="destinations-footer">
          <h3>Others</h3>
          <h4 style="font-size: 15px; margin-bottom: 1rem; color: #ffffff">Join Us & Start Renting Your Property</h4>
          <ul>
              <li><a href="{{ route('vendor.register') }}">ADD YOUR PROPERTY</a></li>
          </ul>
      </div>
      <div class="copyright-footer">
          <h3><i class='bx bx-copyright'></i>All the copy rights reserved to Jobayer & Samantha</h3>
          
      </div>
  </div>
</footer>   

@endsection