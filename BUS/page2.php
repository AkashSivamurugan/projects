<!DOCTYPE html>

<html>

<head>

    <title>Bus Route Destination</title>
    <style>
      *, *:before, *:after {
  -moz-box-sizing: border-box;
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
}

html {
  font-family: Helvetica, Arial, sans-serif;
  font-size: 100%;
  background: #333;
  -webkit-font-smoothing: antialiased;
}

#page-wrapper {
  width: 640px;
  background: #FFFFFF;
  padding: 1em;
  margin: 1em auto;
  border-top: 5px solid #69c773;
  box-shadow: 0 2px 10px rgba(0,0,0,0.8);
}

h1 {
  margin-top: 0;
}

label {
  display: block;
  margin-top: 2em;
  margin-bottom: 0.5em;
  color: #999999;
}

input {
  width: 100%;
  padding: 0.5em 0.5em;
  font-size: 1.2em;
  border-radius: 3px;
  border: 1px solid #D9D9D9;
}


button {
  display: inline-block;
  border-radius: 3px;
  border: none;
  font-size: 0.9rem;
  padding: 0.5rem 0.8em;
  background: #69c773;
  border-bottom: 1px solid #498b50;
  color: white;
  -webkit-font-smoothing: antialiased;
  font-weight: bold;
  margin: 0;
  width: 100%;
  text-align: center;
}

button:hover, button:focus {
  opacity: 0.75;
  cursor: pointer;
}

button:active {
  opacity: 1;
  box-shadow: 0 -3px 10px rgba(0, 0, 0, 0.1) inset;
}
</style>
</head>
<body>
  


<div id="page-wrapper">
<div>
   <?php 
                    if(isset($_SESSION['status']))
                    {
                        ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Hey!</strong> <?php echo $_SESSION['status']; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php
                         unset($_SESSION['status']);
                    }
                ?></div>
  <h1>Bus Timing's</h1>
  <form action="p2code.php" method="POST">
  <div class="from-group mb-3">
                                <label for="">BUS TYPE</label>
                                <select name="type" class="form-control"  required="" >
                                    <option ></option>
                                    <option value="1">Type-1</option>
                                    <option value="2">Type-2</option>
                                    <option value="3">Type-3</option>
                                </select>
                            </div>
  <div class="from-group mb-3">
                                <label for="">BUS TIME MODE</label>
                                <select name="mode" class="form-control"  required="" >
                                   <option></option>
                                    <option value="1">AM</option>
                                    <option value="2">PM</option>
                                    
                                </select>
                            </div>
                            <div class="from-group mb-3">
                                <label for="">BUS ROUTE</label>
                                <select name="route" class="form-control"  required="" >
                                    <option ></option>
                                    <option value="1">Route-1</option>
                                    <option value="2">Route-2</option>
                                    <option value="3">Route-3</option>
                                </select>
                            </div>
                            <div class="from-group mb-3">
                                <label for="">BUS CORPORATION</label>
                                <select name="crp" class="form-control"  required="" >
                                    <option ></option>
                                    <option value="1">Crp-1</option>
                                    <option value="2">Crp-2</option>
                                    <option value="3">Crp-3</option>
                                </select>
                            </div>
  
  
  
</div>
</option>

<style>
   button {
            position: relative;left: 45%;bottom: -20px;
            background-color: #007bff;
            color: #fff;
            width: 12%;
            padding: 10px 50px;
            border: none;
            font-size: 18px;
            cursor: pointer;
            border-radius: 10px;
            margin-bottom: 20px;}
          </style>

 <div class="from-group mb-3">
                                <button type="submit" name="save" class="btn btn-primary">Search</button>
                            </div>
</form>
</body>