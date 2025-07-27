#!/bin/bash

# Navigate to the directory of the script
cd "$(dirname "$0")"

# Perform the deletion actions
find . -name "*.scss" -type f -delete
find . -name "*.map" -type f -delete
find . -name "*.md" -type f -delete
find . -name ".prettierrc" -type f -delete
rm -rf .git
rm -rf .vscode
rm -rf scss

# Delete the script itself
rm "$0"