# [Base](base.md) / [Debug](debug.md) / ExecutionTime
 > im\debug\ExecutionTime
____

## Description
Easily get the execution time for a portion of your code.

This class allows you to add as many markers as you'd like, which
will be used to calculate an average time from the marked beginning.

## Synopsis
```php
class ExecutionTime implements Stringable {

    // Methods
    public getTime(): int
    public run(int $rounds, callable $test): int
    public begin(): void
    public mark(): void
}
```

## Methods
| Name | Description |
| :--- | :---------- |
| [__ExecutionTime&nbsp;::&nbsp;getTime__](debug-ExecutionTime-getTime.md) | Get the average time from `begin` to each `mark` |
| [__ExecutionTime&nbsp;::&nbsp;run__](debug-ExecutionTime-run.md) | Run a test for `$rounds` times and return the average execution time |
| [__ExecutionTime&nbsp;::&nbsp;begin__](debug-ExecutionTime-begin.md) | Mark the beginning |
| [__ExecutionTime&nbsp;::&nbsp;mark__](debug-ExecutionTime-mark.md) | Add a mark that will track from last mark or the beginning |

## Example 1
```php
$ext = new ExecutionTime();
$ext->begin();

for ( ... ) {
    // Code to run

    $ext->mark(); // Mark this execution round
}

echo "Average time: {$ext->getTime()} ms";
```
