# Hector assessment for Werkspot

This is my approach to the Mars Rover Challenge.

I will try to solve it with a "pomodoro" approach. I will divide the 3 hours I have into 6 packs, consisting of 25 min of execution and 5 for a break in between.

I am already a bit behind the first pomodoro so let's get started.

1st part: designing.
I am going to take the remaining time I have to think of the approach.
Drafting the solution in a paper. Hang on there!

End of the first part. I have some questions for the Product Owner. Since he is not in the office now, I am going to have to make some assumptions. Hope he is okey with that.

Assumption 1

Rovers are not suicidal. If the command pushes them over the cliff they will just stop there. That is still considered an acceptable command.

Assumption 2

Rovers are solid and aware of each other. If Rover 2 is asked to move to the same position of through the same position as Rover 1, it will stop there and will not take further instructions.

Assumption 3

Program will stop if any of the instructions is invalid. This means that if the movement instruction contains something different than L, R or M the program will complain and nothing will be moved.

Assumption 4

Rovers cannot appear outside the Plateau. Since we know the dimensions of it when Rover starting point is inputted, program will complain that Rover cannot start there.

2nd Part: structure.
I am going to start writing the overall structure of the application as I see it. Code will not work and it will mostly be dummy stuff, but it will help me get started.

I definitely have some doubts regarding some decisions I am taking. But I am against the clock so I decided I am going for the "easy" solution and if I have time later, I will refactor.

End of second part. Ugh, got into some problems with php 7.1. I had 7.0 installed in my local and vagrant was not making my life easier. Went for the quickfix and installed 7.1 in local with homebrew.

Couldn't finish the structural mock up so I am behind. In the next pomodoro I will try to have the structure finished, tests running at least in a empty state.

I should as well have the console command working with the expected input.
