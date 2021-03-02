# [Base](base.md) / [Debug](debug.md) / SystemTime
 > im\debug\SystemTime
____

## Description
This extended `ExecutionTime` uses PHP's `getrusage()` to get execution time from the system call.

This can be useful if you want to be able to distinguish between user and system time.
However this does not play well on some platforms or on code begin run on virtual machines.

## Synopsis
```php
class SystemTime extends im\debug\ExecutionTime implements Stringable {

    // Methods
    public getTime(): int
    public getUserTime(): int
    public getSystemTime(): int
    public begin(): void
    public mark(): void

    // Inherited Methods
    public run(int $rounds, callable $test): int
}
```

## Methods
| Name | Description |
| :--- | :---------- |
| [__SystemTime&nbsp;::&nbsp;getTime__](debug-SystemTime-getTime.md) | Get the average time from `begin` to each `mark` |
| [__SystemTime&nbsp;::&nbsp;getUserTime__](debug-SystemTime-getUserTime.md) | Get the average user time |
| [__SystemTime&nbsp;::&nbsp;getSystemTime__](debug-SystemTime-getSystemTime.md) | Get the average system time |
| [__SystemTime&nbsp;::&nbsp;begin__](debug-SystemTime-begin.md) | Mark the beginning |
| [__SystemTime&nbsp;::&nbsp;mark__](debug-SystemTime-mark.md) | Add a mark that will track from last mark or the beginning |
| [__SystemTime&nbsp;::&nbsp;run__](debug-SystemTime-run.md) | Run a test for `$rounds` times and return the average execution time |
