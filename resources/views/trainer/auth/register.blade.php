@extends('layouts.app')
@section('content')
    <main class="register-main">
    	<div class="registration-block">
    		<p>Գրանցվել</p>
    		<form action="#">
    			<input type="text" placeholder="Անուն Ազգանուն">
    			<input type="tel" placeholder=" Հեռ։">
    			<input type="email" placeholder="էլ-փոստ">
    			<input type="text" placeholder="Աշխատանքի վայրը">
    			<input type="text" placeholder="Հասցե">
    			<!-- <input type="text" placeholder="Ծննդյան ամիս ամսաթիվ"> -->
				<span class="d-of-birth">Ծննդյան ամիս ամսաթիվ</span>
    			<div class="bfh-datepicker">
    			  <div class="input-prepend bfh-datepicker-toggle" data-toggle="bfh-datepicker">
    			    <span class="add-on"><i class="icon-calendar"></i></span>
    			    <input type="text" class="input-medium">
    			  </div>
    			  <div class="bfh-datepicker-calendar">
    			    <table class="calendar table table-bordered">
    			      <thead>
    			        <tr class="months-header">
    			          <th class="month" colspan="4">
    			            <a class="previous" href="#"><i class="icon-chevron-left"></i></a>
    			            <span></span>
    			            <a class="next" href="#"><i class="icon-chevron-right"></i></a>
    			          </th>
    			          <th class="year" colspan="3">
    			            <a class="previous" href="#"><i class="icon-chevron-left"></i></a>
    			            <span></span>
    			            <a class="next" href="#"><i class="icon-chevron-right"></i></a>
    			          </th>
    			        </tr>
    			        <tr class="days-header">
    			        </tr>
    			      </thead>
    			      <tbody>
    			      </tbody>
    			    </table>
    			  </div>
    			</div>
    			<input type="submit" value="Գրանցվել">
    		</form>
    	</div>
    </main>
@endsection