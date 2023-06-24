<!DOCTYPE html>
<html>
<head>
  <title>Money Input Example</title>
  <script>
    // Format the input value as currency in Sri Lankan Rupees
    function formatCurrency(input) {
      var formatter = new Intl.NumberFormat('si-LK', {
        style: 'currency',
        currency: 'LKR',
      });
      input.value = formatter.format(input.value);
    }
  </script>
</head>
<body>
  <label for="money-input">Enter amount:</label>
  <input type="number" id="money-input" onkeyup="formatCurrency(this)">
</body>
</html>
