# [Debug](debug.md) / [ExecutionTime](debug-ExecutionTime.md) :: run
 > im\debug\ExecutionTime
____

## Description
Run a test for `$rounds` times and return the average execution time.

## Synopsis
```php
public run(int $rounds, callable $test): int
```

## Parameters
| Name | Description |
| :--- | :---------- |
| rounds | Times to run the test |
| test | A callable to call on each round |

## Return
This will return the average execution time in milliseconds.

## Example 1
```php
$ext = new ExecutionTime();
$time = $ext->run(10, function(){
    // Code to run
});

echo "Average time: $time ms";
```
