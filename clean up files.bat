@echo off
cd %~dp0

REM Perform the deletion actions
del *.scss *.map *.md /s /q
rd /s /q .git
rd /s /q .vscode
rd /s /q scss

REM Delete the batch script itself
del %0