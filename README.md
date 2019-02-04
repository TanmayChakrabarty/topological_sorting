# Topological Sorting

Sometimes, we fall into situations where we have a list of tasks to be done, but with a condition that each of the tasks may need one or more tasks from the list to be done before them. Let’s, consider that we have to do tasks a,b,c,d and the condition is b & d has to be done before the task a, then the sorting will become b,d,a,c. 

[Read More](https://www.onlineclassnotes.com/2016/03/sort-dependency-list-or-topological-sorting-in-php.html)

## How to use

Consider that you have a an array of items (tasks) as follows

```php
$items = array('a', 'b', 'c', 'd');
```

Also consider that their dependency is in another array as follows

```php
$dependencyList = array('a' => array('c', 'b'), 'c' => array('d'));
```

The above dependency list describes that tasks 'c' and 'b' has to be done before doing 'a' and tasks 'd' has to be done before doing task 'c'

Then you call the topological sorting function as follows

```php
$sortedItems = _topological_sort($items, $dependencyList);
```

In return you get the ordered task list in an array.

## Unsortable dependency list

If two tasks depends on each other then it can never be done. In that case the this sorting function will return FALSE

Optionally, you can send an array as the third parameter as follows

```php
$ERROR = array();
$sortedItems = _topological_sort($items, $dependencyList, $ERROR);
```

Your given array will be filled with those two tasks which are dependent on each other causing the error.
