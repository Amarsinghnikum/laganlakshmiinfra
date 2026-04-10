@echo off
REM Batch script to build and deploy React app
REM Usage: deploy-react.bat

setlocal enabledelayedexpansion

echo ================================================
echo Building React App...
echo ================================================

REM Navigate to React app directory
cd resources\views\react-app

REM Check if node_modules exists
if not exist "node_modules" (
    echo Installing dependencies...
    call npm install
)

REM Build the React app
echo.
echo Running npm build...
call npm run build

if %errorlevel% neq 0 (
    echo Build failed!
    exit /b 1
)

echo Build completed successfully!

REM Go back to project root
cd ..\..\..

echo.
echo ================================================
echo Deploying to public/build...
echo ================================================

REM Remove old build if it exists
if exist "public\build" (
    echo Removing old build...
    rmdir /s /q public\build
)

REM Copy new build
echo Copying new build...
xcopy "resources\views\react-app\build" "public\build" /E /I /Y

echo.
echo ✓ Deployment completed successfully!
echo.
echo Your React app is now live at: http://localhost:8000
echo Press Ctrl+Shift+Delete in your browser to clear cache if needed.

pause
